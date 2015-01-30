<?php
/*
 * Helper Utils
 * @info: Métodos para tareas variadas
 * 
 * @utor: Moisés Alcocer
 * http://www.ironwoods.es
 * Junio 2014, Cambialibros 
 */
 
final class Utils {

	/**********************************/
	/*** Declaración de Propiedades ***/

		private static $clase = 'Helper Utils';
	


	/**********************************/
	/*** Declaración de Métodos *******/


	/*** Métodos públicos de la clase ***/

		/**
		 * Devuelve un string a partir del array dado
		 * @param array $array
		 * @param string $separador
		 * @return string
		 */
		public static function array_to_string( $array=NULL, $separador=' ' ) {
			echo( self::$clase .' / array_to_string()' );

			//Array pasado con contenido (array vacio no se evalua)
			if ( $array && is_array( $array ) )
				return implode( $separador, $array );
			  
			return FALSE;
		}

		/**
		 * Devuelve la parte inicial de un texto con una longitud máx. en palabras o letras (no trunca palabras)
		 * @param string $texto -> Texto original
		 * @param int $largo_max -> Número entero que indica la longitud 
		 * @param string $contar_en -> longitud máxima: 'letras' | 'palabras' (default: 'letras')
		 * @return string -> Texto cortado
		 */
		public static function cortar_texto( $texto=NULL, $largo_max=NULL, $contar_en='letras' ) {
	  
			if ( is_string( $texto ) && (int)$largo_max > 0 ) {
	  
				if ( $contar_en === 'palabras' ) {
					$num_palabras_texto = str_word_count( $texto, 0, '&' );
		   
					return ( $largo_max >= $num_palabras_texto )
						? $texto 
						: self::cortar_en_espacio( $texto, $largo_max );
		  		}
	  
				if ( $contar_en === 'letras' ) {
					$num_letras_texto = strlen( $texto );
	   
					if ( $largo_max >= $num_letras_texto )
						return $texto;

					else {
						
						//Extrae el texto entre el inicio y el nº de caracteres indicado+1 (x si acabara la palabra)
						$fragmento_inicio_cadena = substr( $texto, 0, $largo_max );
						$num_letras_fragmento = strlen( $fragmento_inicio_cadena );
						$posicion_final_fragmento = $num_letras_fragmento - 1;
						$ultimo_caracter = $fragmento_inicio_cadena[ $posicion_final_fragmento ];
						
						//Último caracter del fragmento es un espacio o una coma
						if ( $ultimo_caracter === ' ' || $ultimo_caracter ===',' )
							return rtrim( $fragmento_inicio_cadena ); //Devuelve el fragmento sin el espacio al final

						//Último caracter del fragmento es una letra -> ¿Es el último de una palabra?
						else {
							$fragmento_final_cadena = substr( $texto, $num_letras_fragmento );

							//Primer caracter del fragmento final es un espacio
							if ( strpos( $fragmento_final_cadena, ' ' ) === 0 )
								return $fragmento_inicio_cadena; //Devuelve el fragmento inicial del texto

							//Primer caracter del fragmento es una letra -> 
							//Ultima palabra del fragmento a devolver incompleta: se debe eliminar
							else {
								$num_palabras_fragmento = str_word_count( $fragmento_inicio_cadena, 0, '&' );
								//Devuelve el fragmento inicial del texto con las palabras completas
								return self::cortar_en_espacio( $fragmento_inicio_cadena, ( $num_palabras_fragmento - 3) );
							}
						}
					}
				}
			}
	  
			return FALSE;
		}

		/**
		 * Escapar comillas de una cadena
		 * @param String $cadena
		 * @return String
		 */
		public static function escapar_comillas( $cadena=NULL ) {
	  		echo( self::$clase .' / escapar_comillas()' );
	  
	  		if ( is_string( $cadena ) )
	  			return str_replace( array( "'", '"' ), array( '\'', '\"' ), $cadena );

	  		return FALSE;
		}
		public static function escapar_comillas_2( $cadena=NULL ) {
			echo( self::$clase .' / escapar_comillas_2()' );

			if ( is_string( $cadena ) )
				return filter_var( $cadena, FILTER_SANITIZE_MAGIC_QUOTES );

			return FALSE;
		}

		/**
		 * Convierte un array en un string para INSERTs
		 * @param  array    $datos         
		 * @return string -> Formato "'uno', 'dos', 'tres'"
		 */
		public static function get_valores( $array_datos=NULL ) {
			echo( self::$clase .' / get_valores()' );        
			//dev( $array_datos ); //die( );
			if ( $array_datos ) {
				$lon = count( $array_datos );
  
				$cad = "";
				foreach ( $array_datos as $i => $valor ) {
					//Si el valor dado es nulo o string vacio, añade un NULL al string
					if (is_null( $valor) || $valor==='')
						$cad .= "NULL";

					//Si el valor es entero, considerando que puede ser un hash q comience por numeros
					elseif (((int)$valor > 0) && (strlen( $valor) < 32))
						$cad .= "$valor";

					else
						$cad .= "'" . $valor . "'";

					if ( $lon != 1) 
						$cad .= ', ';
	  				
	  				$lon--;
				}
  
				return $cad;
			}

			return FALSE;
		}

		/**
		 * Cambia acentos de una cadena por sus letras sin acentuar
		 * @param String $cadena ---> String dado
		 * @return String
		 */
		public static function quitar_acentos( $cadena=NULL ) {
	  		echo( self::$clase .' / quitar_acentos()' );

	  		if (is_string( $cadena))
	  			return str_replace( array('Á','É','Í','Ó','Ú','á','é','í','ó','ú'),
								 	array('A','E','I','O','U','a','e','i','o','u'),
								 	$cadena );

			return FALSE;
		}

		/**
		 * Cambia eñes de una cadena por enes
		 * @param String $cadena ---> String dado
		 * @return String
		 */
		public static function quitar_enies( $cadena=NULL ) {
			echo( self::$clase .' / quitar_enies()' );

			if ( is_string( $cadena ) )
				return str_replace( array('Ñ','ñ'), array('N','n'), $cadena );

			return FALSE;
		}

		/**
		 * Cambia espacios de una cadena por el caracter indicado (por defecto guiones bajos)
		 * @param String $cadena ---> String dado
		 * @param String $caracter_sustitucion
	 	 * @return String
		 */
		public static function quitar_espacios( $cadena=NULL, $caracter_sustitucion='_' ) {
			echo( self::$clase .' / quitar_espacios()' );

			if ( is_string( $cadena ) )
				return str_replace( ' ', $caracter_sustitucion, $cadena );

			return FALSE;
		}



		/**
		 * Convierte un string en un array
		 * @param String $cadena ---> String dado
		 * @param String $x  ---> caracter de corte
		 * @return Array
		 */
		public static function string_to_array( $cadena=NULL, $x=' ' ) {
			echo( self::$clase .' / string_to_array()' );
	  
			if (is_string( $cadena))
			return explode( $x, $cadena );

			return FALSE;
		}

		/**
		 * Convierte a minúsculas una cadena ---> suple deficiencias de strtolower con caracteres españoles (ñ y acentos)
		 * @param String $abc
		 * @return String
		 */
		public static function to_lower( $abc=NULL ) {
			echo( self::$clase .' / to_lower()' );

			if ( is_null( $abc ) )
				return FALSE;
		  
			return str_replace( array( 'Á','É','Í','Ó','Ú','Ñ','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z' ), 
								array( 'á','é','í','ó','ú','ñ','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z' ), 
								$abc );
		}

		/**
		 * Convierte a mayúsculas una cadena ---> suple deficiencias de strtoupper con caracteres españoles (ñ y acentos)
		 * @param String $abc
		 * @return String
		 */
		public static function to_upper( $abc=NULL ) {
			echo( self::$clase .' / to_upper()' );

			if ( is_null( $abc ) )
				return FALSE;
		  
			return str_replace( array( 'á','é','í','ó','ú','ñ','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z' ), 
		  						array( 'Á','É','Í','Ó','Ú','Ñ','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z' ),
		  						$abc );
		}



	/*** Métodos privados de la clase -> Auxiliares ***/

		/**
		 * Aux. de cortar_texto
		 * Devuelve el texto del inicio hasta la posicion del espacio número x
		 * @param string -> String dado
		 * @param int -> Indica nº de espacio donde cortar (default: 0 -> corta al primer espacio)
		 * @return string -> Cadena cortada
		 */
		private static function cortar_en_espacio( $texto=NULL, $num_espacio=0 ) {

			$fragmento_final_cadena  = self::cortar_desde_palabra( $texto, $num_espacio );
			$long_fragmento_inicio_cadena = strlen( $texto) - strlen( $fragmento_final_cadena );
			$fragmento_inicio_cadena  = substr( $texto, 0, $long_fragmento_inicio_cadena );

	  		return rtrim( $fragmento_inicio_cadena );
		}

		/**
		 * Aux. de cortar_en_espacio
		 * Devuelve parte de un string, cortando palabras al principio
		 * @param string -> String dado
		 * @param int -> Indica nº de palabra desde la que cortar (default: 0 -> corta desde la primera)
		 * @return string -> Cadena cortada
		 */
		private static function cortar_desde_palabra( $texto=NULL, $num_palabra=0 ) {

			while ( $num_palabra >= 0 ) {
				$texto = trim( strchr( $texto, ' ' ) );
				$num_palabra--;
			}

			return $texto;
		}


} //class
