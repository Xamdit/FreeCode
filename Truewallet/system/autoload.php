<?php
namespace LolipopKunGz;
class payload {
	
	public function call($function)
{
	return include("system/class_".$function.".php");
}


}
