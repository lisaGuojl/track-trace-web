<?php
/**
 * Created by PhpStorm.
 * User: lisagjl
 * Date: 07/10/18
 * Time: 下午4:24
 */


require './common.php';

echo json_encode(Session::getCurrentSession()->getUser());