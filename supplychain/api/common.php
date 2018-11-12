<?php


$id = $_COOKIE["id"];
$auth_key = $_COOKIE["au"];

$dbh = getDBH();

try {
    $session = Session::getCurrentSession($id, $auth_key);
    $username = $session->getUser()['username'];
} catch (Exception $e) {
    header('index.html');
    exit('ACCESS DENIED, login required');
}

class Session
{
    private $current_user;

    private function __construct($session_id, $auth_key)
    {
        $stmt1 = getDBH()->prepare("SELECT username FROM session WHERE id=? AND auth_key=?");
        $stmt1->execute([$session_id, $auth_key]);
        $username = $stmt1->fetch(PDO::FETCH_ASSOC);
        if (empty($username)) {
            throw new Exception("invalid session");
        }
        $username = $username['username'];

        $stmt2 = getDBH()->prepare('SELECT username, role FROM login WHERE username=?');
        $stmt2->execute([$username]);
        $this->current_user = $stmt2->fetch(PDO::FETCH_ASSOC);
    }

    public static function getCurrentSession(): Session
    {
        static $current = null;
        if ($current === null) {
            list($session_id, $auth_key) = func_get_args();
            $current = new Session($session_id, $auth_key);
        }
        return $current;
    }

    public function checkUserPermission(int $permission): bool
    {
        return in_array($permission, Role::getPermissionsByRole(self::getUser()['role']));
    }

    public function getUser()
    {
        $res = $this->current_user;
        foreach ($res as $k => $_) {
            if (in_array($k, ['password'])) {
                unset($res[$k]);
            }
        }
        $res['permissions'] = Role::getPermissionsByRole($res['role']);
        return $res;
    }

}

class Role
{
    const PERMISSION_POST = 1;
    const PERMISSION_VIEW_RECORDS = 2;
    const PERMISSION_QUERY_RECORDS = 3;
    const PERMISSION_GO_NEXT = 4;
    const PERMISSION_BLOCKCHAIN = 5;
    const PERMISSION_ACCOUNTALL = 6;
    const PERMISSION_HISTORY = 7;

    const ROLE_ADMIN = 7;
    const ROLE_FACTORY = 1;
    const ROLE_DISTRIBUTOR = 2;
    const ROLE_WAREHOUSE = 3;
    const ROLE_TRADER = 4;
    const ROLE_MERCHANT = 5;
    const ROLE_CUSTOMER = 6;

    const ROLE_PERMISSION_MAPPING = [
        self::ROLE_ADMIN => [self::PERMISSION_POST, self::PERMISSION_VIEW_RECORDS, self::PERMISSION_QUERY_RECORDS, self::PERMISSION_GO_NEXT, self::PERMISSION_BLOCKCHAIN, self::PERMISSION_ACCOUNTALL, self::PERMISSION_HISTORY],
        self::ROLE_FACTORY => [self::PERMISSION_POST],
    ];

    public static function getPermissionsByRole(int $role): array
    {
        return self::ROLE_PERMISSION_MAPPING[$role] ?? [];
    }

}

function getDBH()
{
    static $dbh = null;
    if ($dbh === null) {
        $dbh = new PDO("mysql:dbname=supplychain;host=127.1", "supplyuser", "chainuser");
    }
    return $dbh;
}