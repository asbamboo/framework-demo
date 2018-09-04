<?php
use asbamboo\frameworkDemo\model\user\Constant;
use asbamboo\security\gurad\authorization\Rule;
use asbamboo\security\gurad\authorization\RuleCollection;
use asbamboo\security\user\Role;

$RuleCollection    = new RuleCollection();
$RuleCollection->addRule(new Rule('
    (in_array("admin", $user->getRoles()) && strncasecmp("/user", $request->getUri()->getPath(), "5") ===0)
||  (strncasecmp("/user", $request->getUri()->getPath(), "5") !==0)
'));
$RuleCollection->addRule(new Rule('
    (!in_array("' . Role::ANONYMOUS . '", $user->getRoles()) && strncasecmp("/post", $request->getUri()->getPath(), "5") ===0)
||  (strncasecmp("/post", $request->getUri()->getPath(), "5") !==0)
'));
return $RuleCollection;

