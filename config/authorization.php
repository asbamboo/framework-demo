<?php
use asbamboo\security\gurad\authorization\Rule;
use asbamboo\security\gurad\authorization\RuleCollection;
use asbamboo\security\user\Role;

$RuleCollection    = new RuleCollection();
$RuleCollection->addRule(new Rule('strncasecmp("/user", $request->getUri()->getPath(), "5") === 0 ? in_array("admin", $user->getRoles()) : true'));
$RuleCollection->addRule(new Rule('strncasecmp("/post", $request->getUri()->getPath(), "5") === 0 ? !in_array("' . Role::ANONYMOUS . '", $user->getRoles()) : true'));
return $RuleCollection;

