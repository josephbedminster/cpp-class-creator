<?php

define("SETTER_PREFIX", "set");
define("GETTER_PREFIX", "get");

getParams();

function prepareOperatorEgal($variables, $name) {
	for($i = 0; $i < count($variables[1]); $i++) {
		$op .= "\tthis->".$variables[1][$i][1]." = copy.".$variables[1][$i][1].";\n";
	}
	return $op;
}
//A changer
function prepareConstructorCopy($variables, $name) {
	for($i = 0; $i < count($variables[1]); $i++) {
		$op .= "\tthis->".$variables[1][$i][1]." = copy.".$variables[1][$i][1].";\n";
	}
	return $op;
}

/* PREPARE SETTERS */
function prepareSettersPrivate($variables, $name)
{
	return (prepareSetters(1, $variables, $name));
}

function prepareSettersProtected($variables, $name)
{
	return (prepareSetters(2, $variables, $name));
}

function prepareSettersDefPrivate($variables, $name, $virtual)
{
	return (prepareSettersDef(1, $variables, $name, $virtual));
}

function prepareSettersDefProtected($variables, $name, $virtual)
{
	return (prepareSettersDef(2, $variables, $name, $virtual));
}

function prepareSetters($type, $variables, $name) {
	for($i = 0; $i < count($variables[$type]); $i++) {
		$setters .= "\n";
            if (count($variables[$type][$i]) >= 2) { //Il faut au minimum un type et un nom de variable
            	if (!empty($variables[$type][$i][2]))
            		$isConst = $variables[$type][$i][2];
            	else
            		$isConst = "";
            	$setters .= "void\t".$name."::".SETTER_PREFIX.ucfirst($variables[$type][$i][1])."(const ".$variables[$type][$i][0]." ".$variables[$type][$i][1]." ".$variables[$type][$i][2].") const\n{\n";
            	$setters .= "\tthis->".$variables[$type][$i][1]." = ".$variables[$type][$i][1].";\n}\n";
            }
    }
    return $setters;
}

function prepareSettersDef($type, $variables, $name, $virtual) {
	$setters .= "\t";
	for($i = 0; $i < count($variables[$type]); $i++) {
		if ($virtual == true) {
			$setters .= "virtual\t";
		}
	if (count($variables[$type][$i]) >= 2) { //Il faut au minimum un type et un nom de variable
		if (!empty($variables[$type][$i][2]))
			$isConst = $variables[$type][$i][2];
		else
			$isConst = "";
		$setters .= "void\t".SETTER_PREFIX.ucfirst($variables[$type][$i][1])."(const ".$variables[$type][$i][0]." ".$variables[$type][$i][1]." ".$variables[$type][$i][2].") const;";
	}
}
return $setters;
}

/* PREPARE GETTERS */
function prepareGettersPrivate($variables, $name)
{
	return (prepareGetters(1, $variables, $name));
}

function prepareGettersProtected($variables, $name)
{
	return (prepareGetters(2, $variables, $name));
}

function prepareGettersDefPrivate($variables, $name, $virtual)
{
	return (prepareGettersDef(1, $variables, $name, $virtual));
}

function prepareGettersDefProtected($variables, $name, $virtual)
{
	return (prepareGettersDef(2, $variables, $name, $virtual));
}

function prepareGetters($type, $variables, $name) {
	for($i = 0; $i < count($variables[$type]); $i++) {
		$getters .= "\n";
	if (count($variables[$type][$i]) >= 2) { //Il faut au minimum un type et un nom de variable
		if (!empty($variables[$type][$i][2]))
			$isConst = $variables[$type][$i][2];
		else
			$isConst = "";
		$getters .= $variables[$type][$i][0]."\t".$name."::".GETTER_PREFIX.ucfirst($variables[$type][$i][1])."() const\n{\n";
		$getters .= "\treturn (this->".$variables[$type][$i][1].");\n}\n";
	}
}
return $getters;
}

function prepareGettersDef($type, $variables, $name, $virtual) {
	$gettersDef .= "\t";
	if ($virtual == true) {
		$gettersDef .= "virtual\t";
	}
	for($i = 0; $i < count($variables[$type]); $i++) {

            if (count($variables[$type][$i]) >= 2) { //Il faut au minimum un type et un nom de variable
            	if (!empty($variables[$type][$i][2]))
            		$isConst = $variables[$type][$i][2];
            	else
            		$isConst = "";
            	$gettersDef .= "\t".GETTER_PREFIX.ucfirst($variables[$type][$i][1])."() const;";
            }
    }
    return $gettersDef;
}

/* PREPARE VARIABLES */
function prepareVariables($variables) {
	if ($variables[0] != null) {
		for ($i = 0; $i < count($variables[0]); $i++) {
			for ($j = 0; $j < count($variables[0][$i]); $j++) {
				$vars[0] .= "\t".$variables[0][$i][$j];
			}
			$vars[0] .= ";\n";
		}
	}
	else $variables[0] = null;
	if ($variables[1] != null) {
		$vars[1] = "\nprivate:\n";
		for ($i = 0; $i < count($variables[1]); $i++) {
			for ($j = 0; $j < count($variables[1][$i]); $j++) {
				$vars[1] .= "\t".$variables[1][$i][$j];
			}
			$vars[1] .= ";\n";
		}
	}
	else $variables[1] = null;
	if ($variables[2] != null) {
		$vars[2] = "\nprotected:\n";
		for ($i = 0; $i < count($variables[2]); $i++) {
			for ($j = 0; $j < count($variables[2][$i]); $j++) {
				$vars[2] .= "\t".$variables[2][$i][$j];
			}
			$vars[2] .= ";\n";
		}
	}
	else $variables[2] = null;
	return ($vars);
}

function getVariables() {
	echo "Format des variables à envoyer : [type] [name] (const), ex: int i const, void afficher const\n";
	echo "Variables publiques : ";
	$temp = trim(fgets(STDIN));
	if ($temp != null) {
		$variables_pub = explode( ', ', $temp );
		for($i = 0; $i < count($variables_pub); $i++)
			$variables[0][$i] = explode(' ', $variables_pub[$i] );
	}
	else
		$variables[0] = null;

	echo "Variables privées : ";
	$temp = trim(fgets(STDIN));
	if ($temp != null) {
		$variables_pri = explode( ', ', $temp );
		for($i = 0; $i < count($variables_pri); $i++)
			$variables[1][$i] = explode(' ', $variables_pri[$i] );
	}
	else
		$variables[1] = null;

	echo "Variables protégées : ";
	$temp = trim(fgets(STDIN));
	if ($temp != null) {
		$variables_pro = explode( ', ', $temp );
		for($i = 0; $i < count($variables_pro); $i++)
			$variables[2][$i] = explode(' ', $variables_pro[$i] );
	}
	else
		$variables[2] = null;
	return($variables);

}

function getParams() {
	if (!is_writable(".")) {
		echo "Change rights of this folder before continue";
		exit;
	}

	echo "Login : ";
	$login = trim(fgets(STDIN));
	echo "NOM Prenom : ";
	$student = trim(fgets(STDIN));
	echo "Nom de la classe : ";
	$name = trim(fgets(STDIN));
	echo "Classe virtuelle ? y/n : ";
	if(trim(fgets(STDIN)) == 'y')
		$virtual = true;
	echo "Include default lib ? y/n : ";
	$includes = trim(fgets(STDIN));
	echo "Ajouter des variables ? y/n : ";
	if(trim(fgets(STDIN)) == 'y')
		$variables = getVariables();
	$name_cpp = $name.".cpp";
	$name_hh = $name.".hh";
	if (file_exists($name_cpp) || file_exists($name_hh)) {
		echo $name." : La classe existe déjà ! \nEcraser ? y/n";
		if (trim(fgets(STDIN))) {
			$cmd = "rm ".$name_hh." ".$name_cpp;
			exec($cmd);
		}
	}
	classCreat($name, $student, $virtual, $includes, $login, $variables);
}

function classCreat($name, $student, $virtual, $includes, $login, $variables) {
	date_default_timezone_set( 'Europe/Paris' );
	$name_hh = $name.".hh";
	$name_cpp = $name.".cpp";
	$template_hh = file_get_contents("templates/template_hh.log");
	$template_cpp = file_get_contents("templates/template_cpp.log");

	$vars = prepareVariables($variables);
	$date = date("D")." ".date("M")."  ".date("j")." ".date("h:i:s")." ".date("Y");
	$path = getcwd();
    	// CREATION DU HEADER
	$template_hh = preg_replace("/{{login}}/", $login, $template_hh);
	$template_hh = preg_replace("/{{student}}/", $student, $template_hh);
	$template_hh = preg_replace("/{{classname}}/", $name, $template_hh);
	$template_hh = preg_replace("/{{maj_classname}}/", strtoupper($name), $template_hh);
	$template_hh = preg_replace("/{{date}}/", $date, $template_hh);
	$template_hh = preg_replace("/{{path}}/", $path, $template_hh);
    	// Déclaration de variables
	$template_hh = preg_replace("/{{vars0}}/", $vars[0], $template_hh);
	$template_hh = preg_replace("/{{vars1}}/", $vars[1], $template_hh);
	$template_hh = preg_replace("/{{vars2}}/", $vars[2], $template_hh);
	// Déclaration des prototypes des getters private
	$gettersDefPrivate = prepareGettersDefPrivate($variables, $name, $virtual);
	$template_hh = preg_replace("/{{gettersDefPrivate}}/", $gettersDefPrivate, $template_hh);
	// Déclaration des prototypes des getters protected
	$gettersDefProtected = prepareGettersDefProtected($variables, $name, $virtual);
	$template_hh = preg_replace("/{{gettersDefProtected}}/", $gettersDefProtected, $template_hh);
	// Déclaration des prototypes des setters private
	$settersDefPrivate = prepareSettersDefPrivate($variables, $name, $virtual);
	$template_hh = preg_replace("/{{settersDefPrivate}}/", $settersDefPrivate, $template_hh);
	// Déclaration des prototypes des setters protected
	$settersDefProtected = prepareSettersDefProtected($variables, $name, $virtual);
	$template_hh = preg_replace("/{{settersDefProtected}}/", $settersDefProtected, $template_hh);
	// Virtual remplacement
	if ($virtual)
		$template_hh = preg_replace("/{{virtual}}/", "virtual", $template_hh);
	else
		$template_hh = preg_replace("/{{virtual}}/", "", $template_hh);


	if ($includes =='y')
		$template_hh = preg_replace("/{{includes}}/", "#include <string>\n#include <iostream>", $template_hh);
	file_put_contents($name_hh, $template_hh);

    	// CREATION DU CPP
	$template_cpp = preg_replace("/{{login}}/", $login, $template_cpp);
	$template_cpp = preg_replace("/{{student}}/", $student, $template_cpp);
	$template_cpp = preg_replace("/{{classname}}/", $name, $template_cpp);
	$template_cpp = preg_replace("/{{maj_classname}}/", strtoupper($name), $template_cpp);
	$template_cpp = preg_replace("/{{date}}/", $date, $template_cpp);
	$template_cpp = preg_replace("/{{path}}/", $path, $template_cpp);
    	// Création des setters private
	$settersPrivate = prepareSettersPrivate($variables, $name);
	$template_cpp = preg_replace("/{{settersPrivate}}/", $settersPrivate, $template_cpp);
	// Création des setters protected
	$settersProtected = prepareSettersProtected($variables, $name);
	$template_cpp = preg_replace("/{{settersProtected}}/", $settersProtected, $template_cpp);
    	// Création des getters private
	$gettersPrivate = prepareGettersPrivate($variables, $name);
	$template_cpp = preg_replace("/{{gettersPrivate}}/", $gettersPrivate, $template_cpp);
    	// Création des getters protected
	$gettersProtected = prepareGettersProtected($variables, $name);
	$template_cpp = preg_replace("/{{gettersProtected}}/", $gettersProtected, $template_cpp);
	// Création de l'opérateur =
	$operatorEgal = prepareOperatorEgal($variables, $name);
	$template_cpp = preg_replace("/{{operatorEgal}}/", $operatorEgal, $template_cpp);
	// Création du constructeur copy
	$constructorCopy = prepareConstructorCopy($variables, $name);
	$template_cpp = preg_replace("/{{constructorCopy}}/", $constructorCopy, $template_cpp);

	file_put_contents($name_cpp, $template_cpp);

	echo "Fichiers créés : ".$name_cpp." + ".$name_hh."\n";
	echo "Ouvrir les fichiers ? y (default), s (SublimText), n (No) : ";
	$open = trim(fgets(STDIN));
	if ($open == 'y')
		exec("open ".$name_cpp." && open ".$name_hh);
	else if ($open == 's')
		exec("/Applications/Sublime\ Text.app/Contents/SharedSupport/bin/subl .");
	return;

}