<?php
namespace Library;
class Exception extends \Exception
{
     const APPLICATION_EXCEPTION = 'An Application exception was thrown and not caught this might be a bug.';
     const Warning = 'An Application Warning has occured.';
     const Error = 'An Application Error has occured';
     const FatalError = 'A Fatal Application Error has occured';
}