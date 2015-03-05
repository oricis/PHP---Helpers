Librería con Helpers

Los Helpers incluidos son clases que agruparan métodos para realizar tareas comunes.

Forma de organizar las clases.
	Cuando se incluyen métodos nuevos, pueden incluirse en la clase Utils. Cuando están destinados a un propósito concreto se crea un helper con un nombre acorde que las agrupe. Si en Utils hay cierto número de métodos destinados a un propósito concreto, se extraerán agrupándose en un nuevo helper para tal fin.

Helpers disponibles:
	- Utils.
		Agrupa métodos para varios propósitos, básicamente, para trabajo con strings.

Test
Los test se situan en el directorio test/
Los test de los m�todos de cada clase se encuentran dentro de un subdirectorio nombrado como test_nombre_clase/ p.e. test_utils/ 
Otros ficheros requeridos para ejecutar los test se encuentran en el subdirectorio vars/
La estructura quedar�a as�:

repo/
	ficheros.php
	utils.php
	test/
		test_ficheros/
		test_utils/
			test_ordenar_objetos.php
	vars/
		clases.php