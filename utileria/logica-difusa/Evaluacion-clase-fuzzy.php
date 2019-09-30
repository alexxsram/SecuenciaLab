<?php
include('BiblioFuzzy.php');
class SistemaFuzzyEvalucionClase
{
  /*Declaración de los conjuntos difusos para las variables de entrada,
  * intermedias y de salida del sistema.
  * Estos conjuntos difusos representan los conjuntos lingüísticos y los rangos
  * seleccionados para cada uno de los indicadores de la problemática.
  */
  //****************************************************************************
  //----------------------------Variables de entrada----------------------------
  //Conjuntos difusos sobre el simulador
  private $dificultadUtilSimualdor = [ "MuyDificil", "Dificil", "Regular",
  "Facil", "MuyFacil" ];
  private $apoyoSimulador = [ "Mala", "Insuficiente", "Promedio", "Buena",
  "Excelente" ];
  //Conjuntos difusos sobre el material de apoyo
  private $claridadMaterialApoyo = [ "NadaClaro", "PocoClaro", "Claro",
  "MuyClaro", "Clarisimo" ];
  private $calidadMaterialApoyo = [ "Mala", "Insuficiente", "Promedio", "Buena",
  "Excelente" ];
  private $cantidadMaterialApoyo = [ "MuyPoco", "Poco", "Suficiente", "Mucho",
  "Demasiado" ];
  //Conjuntos difusos sobre el contenido de la clase
  private $claridadContenido = [ "NadaClaro", "PocoClaro", "Claro", "MuyClaro",
  "Clarisimo" ];
  private $calidadContenido = [ "Mala", "Insuficiente", "Promedio", "Buena",
  "Excelente" ];
  private $cantidadContenido = [ "MuyPoco", "Poco", "Suficiente", "Mucho",
  "Demasiado" ];
  //Conjuntos difusos sobre el aprendizaje
  private $aprendizajeAlumno = [ "Deficiente", "Insuficiente", "Promedio",
  "Buena", "Excelente" ];
  //----------------------------Variable intermedias----------------------------
  private $conjuntosInterSimulador = [ "Deficiente", "Insuficiente", "Promedio",
  "Buena", "Excelente" ];
  private $conjuntosInterMaterialApoyo = [ "Deficiente", "Insuficiente",
  "Promedio", "Buena", "Excelente" ];
  private $conjuntosInterContMateria = [ "Deficiente", "Insuficiente",
  "Promedio", "Buena", "Excelente" ];
  private $conjuntosInterCalClase = [ "Deficiente", "Insuficiente", "Promedio",
  "Buena", "Excelente" ];
  //-----------------------------Variable de salida-----------------------------
  private $conjuntosCalificacionClase = [ "Deficiente", "Insuficiente",
  "Promedio", "Buena", "Excelente" ];

  //****************************************************************************

  /*Arreglos de membresías de las variables de entrada.
  * En estos arreglos de números reales se guardará la membresía que presenta una
  *  determinada variable de entrada en relación a los conjuntos difusos que la
  * representan, cabe mencionar que una variable de entrada puede tener diferentes
  * grados de membresía para más de un conjunto difuso en su espectro de acción.
  */
  //--------------------Conjuntos difusos sobre el simulador--------------------
  private $nivelMembDificultadUtilSimualdor = [0, 0, 0, 0, 0];
  private $nivelMembApoyoSimulador= [0, 0, 0, 0, 0];
  //-------------Conjuntos difusos sobre el contenido de la clase---------------
  private $nivelMembClaridadMaterialApoyo= [0, 0, 0, 0, 0];
  private $nivelMembCalidadMaterialApoyo= [0, 0, 0, 0, 0];
  private $nivelMembCantidadMaterialApoyo= [0, 0, 0, 0, 0];
  //-------------------Conjuntos difusos sobre el aprendizaje-------------------
  private $nivelMembClaridadContenido= [0, 0, 0, 0, 0];
  private $nivelMembCalidadContenido= [0, 0, 0, 0, 0];
  private $nivelMembCantidadContenido= [0, 0, 0, 0, 0];
  //-------------------Conjuntos difusos sobre el aprendizaje-------------------
  private $nivelMembAprendizajeAlumno= [0, 0, 0, 0, 0];

  //****************************************************************************


  /*Arreglos de membresías para las variables intermedias de la evaluación de una
  * clase.
  * En este arreglo de números reales se guardará la membresía que presenta la
  * variable intermedia de la evaluación de cada área de la clase relación a
  * los conjuntos difusos que la representan, cabe mencionar que la variable
  * intermedia puede tener diferentes grados de membresía para más de un
  * conjunto difuso en su espectro de acción.
  */
  private $nivelMembInterSimulador= [0, 0, 0, 0, 0];
  private $nivelMembInterMaterialApoyo= [0, 0, 0, 0, 0];
  private $nivelMembInterContMateria= [0, 0, 0, 0, 0];
  private $nivelMembInterCalClase= [0, 0, 0, 0, 0];

  //****************************************************************************


  /*Arreglo de membresía para la variable de salida de la calificación de la clase.
  * En este arreglo de números reales se guardará la membresía que presenta la
  * variable de salida para la calificación de una clase relación a los conjuntos
  * difusos que la representan, cabe mencionar que la variable intermedia puede
  * tener diferentes grados de membresía para más de un conjunto difuso en su
  * espectro de acción.
  */
  private $nivelMembCalificacionClase= [0, 0, 0, 0, 0];

  //****************************************************************************


  //Variables de intermedias y de salida  ya procesados
  //-----------------------Variables de entrada nitidas-------------------------
  public $dificulSimuNitido;
  public $apoyoSimuNitido;
  public $CalMatApoNitido;
  public $ClarMatApoNitido;
  public $CantMatApoNitido;
  public $CalContNitido;
  public $ClarContNitido;
  public $CantContNitido;
  public $nivelAprendizajeNitido;
  //-----------------------Variables de entrada difusas-------------------------
  public $dificulSimuDifuso;
  public $apoyoSimuDifuso;
  public $CalMatApoDifuso;
  public $ClarMatApoDifuso;
  public $CantMatApoDifuso;
  public $CalContDifuso;
  public $ClarContDifuso;
  public $CantContDifuso;
  public $nivelAprendizajeDifuso;
  //-----------------------Variables intermedias nitidas------------------------
  public $interSimuladorNitido;
  public $interMatApoNitido;
  public $interContNitido;
  public $interCaliClaseNitido;
  //-----------------------Variables intermedias difusas------------------------
  public $interSimuladorDifuso;
  public $interMaterialApoyoDifuso;
  public $interContenidoClaseDifuso;
  public $interCalidadClaseDifuso;
  public $calificacionClaseDifuso;
  //-------------------------Variables de salida nitida-------------------------
  public $CalidadClaseNitido;
  //-------------------------Variables de salida difusa-------------------------
  public $CalificacionClaseNitidaFinal;

  //****************************************************************************


  /*Esta función se encarga de determinar el grado de membresía mayor presente
  * en un arreglo de membresías de números reales.
  * En otras palabras esta función sirve para determinar cuál cual es la posición
  * de mayor membresía que presenta una variable en el sistema difuso en su
  * espectro de variables lingüísticas, con el objetivo de saber cuál es el
  * conjunto difuso que represente con mayor grado de certeza a la variable en
  *  cuestión.
  */
  public function posicionMayorNivelMembresia($nivelesMembresia)
  {
    $posMay = 0;
    for ($i = 0; $i < count($nivelesMembresia); $i++)
    {
      if ($nivelesMembresia[$i] > $nivelesMembresia[$posMay]) $posMay = $i;
    }
    return $posMay;
  }

  //****************************************************************************


  /*Esta función se encarga de imprimir de manera gráfica en consola los niveles
  * de membresía almacenados en un vector de números reales.
  * En otras palabras esta función se encarga de mostrar de manera gráfica ante
  * el usuario los niveles de membresía alcanzados para una determina variable
  * en el sistema difuso, con el objetivo de poder visualizar de manera clara y
  * sencilla el nivel o niveles de membresía que la variable alcanzo y poder
  * visualizar el nivel de traslape ocurrido.
  */
  public function imprimirNivelMembresiaMayor($mensaje, $nivelesMembresia)
  {
    echo $mensaje . ": [";
    $cantidadNivelesMembresia = count($nivelesMembresia);
    for ($i = 0; $i < $cantidadNivelesMembresia; $i++)
    {
      echo $nivelesMembresia[$i];
      if (($i + 1) == $cantidadNivelesMembresia)
      {
        echo "]";
      }
      else
      {
        echo ", ";
      }
    }
    echo "\n<br/>";
  }

  //****************************************************************************


  public function nivelMembresiaAprendizajeAlumno($datoCuantitativoAprendizajeAlumno,
  $mostrar=false)
  {
    $this->nivelMembAprendizajeAlumno[0] =
    BiblioFuzzy::Curva_Z($datoCuantitativoAprendizajeAlumno, 0, 40);
    $this->nivelMembAprendizajeAlumno[1] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoAprendizajeAlumno, 20, 40, 60);
    $this->nivelMembAprendizajeAlumno[2] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoAprendizajeAlumno, 40, 60, 80);
    $this->nivelMembAprendizajeAlumno[3] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoAprendizajeAlumno, 60, 80, 100);
    $this->nivelMembAprendizajeAlumno[4] =
    BiblioFuzzy::Curva_S($datoCuantitativoAprendizajeAlumno, 80, 100);
    if($mostrar){
      $this->imprimirNivelMembresiaMayor(("Membresías Aprendizaje Alumno=
      {$datoCuantitativoAprendizajeAlumno}"), $this->nivelMembAprendizajeAlumno);
    }
  }

  public function nivelMembresiaClaridadContenido($datoCuantitativoClaridadContenido,
  $mostrar=false)
  {
    $this->nivelMembClaridadContenido[0] =
    BiblioFuzzy::Curva_Z($datoCuantitativoClaridadContenido, 0, 40);
    $this->nivelMembClaridadContenido[1] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoClaridadContenido, 20, 40, 60);
    $this->nivelMembClaridadContenido[2] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoClaridadContenido, 40, 60, 80);
    $this->nivelMembClaridadContenido[3] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoClaridadContenido, 60, 80, 100);
    $this->nivelMembClaridadContenido[4] =
    BiblioFuzzy::Curva_S($datoCuantitativoClaridadContenido, 80, 100);
    if($mostrar){
      $this->imprimirNivelMembresiaMayor(("Membresías Claridad Contenido=
      {$datoCuantitativoClaridadContenido}"), $this->nivelMembClaridadContenido);
    }
  }

  public function nivelMembresiaCalidadContenido($datoCuantitativoCalidadContenido,
  $mostrar=false)
  {
    $this->nivelMembCalidadContenido[0] =
    BiblioFuzzy::Curva_Z($datoCuantitativoCalidadContenido, 0, 40);
    $this->nivelMembCalidadContenido[1] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCalidadContenido, 20, 40, 60);
    $this->nivelMembCalidadContenido[2] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCalidadContenido, 40, 60, 80);
    $this->nivelMembCalidadContenido[3] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCalidadContenido, 60, 80, 100);
    $this->nivelMembCalidadContenido[4] =
    BiblioFuzzy::Curva_S($datoCuantitativoCalidadContenido, 80, 100);
    if($mostrar){
      $this->imprimirNivelMembresiaMayor(("Membresías Calidad Contenido=
      {$datoCuantitativoCalidadContenido}"), $this->nivelMembCalidadContenido);
    }
  }

  public function nivelMembresiaCantidadContenido($datoCuantitativoCantidadContenido,
  $mostrar=false)
  {
    $this->nivelMembCantidadContenido[0] =
    BiblioFuzzy::Curva_Z($datoCuantitativoCantidadContenido, 0, 40);
    $this->nivelMembCantidadContenido[1] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCantidadContenido, 20, 40, 60);
    $this->nivelMembCantidadContenido[2] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCantidadContenido, 40, 60, 80);
    $this->nivelMembCantidadContenido[3] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCantidadContenido, 60, 80, 100);
    $this->nivelMembCantidadContenido[4] =
    BiblioFuzzy::Curva_S($datoCuantitativoCantidadContenido, 80, 100);
    if($mostrar){
      $this->imprimirNivelMembresiaMayor(("Membresías Cantidad Contenido= {$datoCuantitativoCantidadContenido}"), $this->nivelMembCantidadContenido);
    }
  }

  public function nivelMembresiaDificultadSimulador($datoCuantitativoDificultadSimulador,
  $mostrar=false)
  {
    $this->nivelMembDificultadUtilSimualdor[0] =
    BiblioFuzzy::Curva_Z($datoCuantitativoDificultadSimulador, 0, 40);
    $this->nivelMembDificultadUtilSimualdor[1] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoDificultadSimulador, 20, 40, 60);
    $this->nivelMembDificultadUtilSimualdor[2] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoDificultadSimulador, 40, 60, 80);
    $this->nivelMembDificultadUtilSimualdor[3] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoDificultadSimulador, 60, 80, 100);
    $this->nivelMembDificultadUtilSimualdor[4] =
    BiblioFuzzy::Curva_S($datoCuantitativoDificultadSimulador, 80, 100);
    if($mostrar){
      $this->imprimirNivelMembresiaMayor(("Membresías Dificultad Simulador={$datoCuantitativoDificultadSimulador}"), $this->nivelMembDificultadUtilSimualdor);
    }
  }

  public function nivelMembresiaApoyoSimulador($datoCuantitativoApoyoSimulador,
  $mostrar=false)
  {
    $this->nivelMembApoyoSimulador[0] =
    BiblioFuzzy::Curva_Z($datoCuantitativoApoyoSimulador, 0, 40);
    $this->nivelMembApoyoSimulador[1] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoApoyoSimulador, 20, 40, 60);
    $this->nivelMembApoyoSimulador[2] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoApoyoSimulador, 40, 60, 80);
    $this->nivelMembApoyoSimulador[3] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoApoyoSimulador, 60, 80, 100);
    $this->nivelMembApoyoSimulador[4] =
    BiblioFuzzy::Curva_S($datoCuantitativoApoyoSimulador, 80, 100);
    if($mostrar){
      $this->imprimirNivelMembresiaMayor(("Membresías Apoyo simulador= {$datoCuantitativoApoyoSimulador}"), $this->nivelMembApoyoSimulador);
    }
  }

  public function nivelMembresiaClaridadMaterialApoyo($datoCuantitativoClaridadMaterialApoyo,
  $mostrar=false)
  {
    $this->nivelMembClaridadMaterialApoyo[0] =
    BiblioFuzzy::Curva_Z($datoCuantitativoClaridadMaterialApoyo, 0, 40);
    $this->nivelMembClaridadMaterialApoyo[1] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoClaridadMaterialApoyo, 20, 40, 60);
    $this->nivelMembClaridadMaterialApoyo[2] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoClaridadMaterialApoyo, 40, 60, 80);
    $this->nivelMembClaridadMaterialApoyo[3] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoClaridadMaterialApoyo, 60, 80, 100);
    $this->nivelMembClaridadMaterialApoyo[4] =
    BiblioFuzzy::Curva_S($datoCuantitativoClaridadMaterialApoyo, 80, 100);
    if($mostrar){
      $this->imprimirNivelMembresiaMayor(("Membresías Claridad Material de Apoyo=
      {$datoCuantitativoClaridadMaterialApoyo}"), $this->nivelMembClaridadMaterialApoyo);
    }
  }

  public function nivelMembresiaCalidadMaterialApoyo($datoCuantitativoCalidadMaterialApoyo,
  $mostrar=false)
  {
    $this->nivelMembCalidadMaterialApoyo[0] =
    BiblioFuzzy::Curva_Z($datoCuantitativoCalidadMaterialApoyo, 0, 40);
    $this->nivelMembCalidadMaterialApoyo[1] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCalidadMaterialApoyo, 20, 40, 60);
    $this->nivelMembCalidadMaterialApoyo[2] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCalidadMaterialApoyo, 40, 60, 80);
    $this->nivelMembCalidadMaterialApoyo[3] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCalidadMaterialApoyo, 60, 80, 100);
    $this->nivelMembCalidadMaterialApoyo[4] =
    BiblioFuzzy::Curva_S($datoCuantitativoCalidadMaterialApoyo, 80, 100);
    if($mostrar){
      $this->imprimirNivelMembresiaMayor(("Membresías Calidad Material de Apoyo=
      {$datoCuantitativoCalidadMaterialApoyo}"), $this->nivelMembCalidadMaterialApoyo);
    }
  }

  public function nivelMembresiaCantidadMaterialApoyo($datoCuantitativoCantidadMaterialApoyo,
  $mostrar=false)
  {
    $this->nivelMembCantidadMaterialApoyo[0] =
    BiblioFuzzy::Curva_Z($datoCuantitativoCantidadMaterialApoyo, 0, 40);
    $this->nivelMembCantidadMaterialApoyo[1] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCantidadMaterialApoyo, 20, 40, 60);
    $this->nivelMembCantidadMaterialApoyo[2] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCantidadMaterialApoyo, 40, 60, 80);
    $this->nivelMembCantidadMaterialApoyo[3] =
    BiblioFuzzy::TriangularSuave($datoCuantitativoCantidadMaterialApoyo, 60, 80, 100);
    $this->nivelMembCantidadMaterialApoyo[4] =
    BiblioFuzzy::Curva_S($datoCuantitativoCantidadMaterialApoyo, 80, 100);
    if($mostrar){
      $this->imprimirNivelMembresiaMayor(("Membresías Cantidad Material de Apoyo=
      {$datoCuantitativoCantidadMaterialApoyo}"), $this->nivelMembCantidadMaterialApoyo);
    }
  }

  //****************************************************************************


  public function fuzzificarDificiltadUtilSimulador($datoCuantitativoDificultadSimulador)
  {
    $conjunto = "";
    /*Se determina y almacena los niveles de membresía que la variable nítida
    * alcanzo en cada uno de los conjuntos difusos que la representan.*/
    $this->nivelMembresiaDificultadSimulador($datoCuantitativoDificultadSimulador);
    /*Se determina la posición en donde la variable alcanzo la membresía más
    * alta en su rango de acción y se obtiene como resultado la variable
    * lingüística que la representa con mayor rango de certeza.*/
    $conjunto = $this->dificultadUtilSimualdor[$this->posicionMayorNivelMembresia($this->nivelMembDificultadUtilSimualdor)];
    //Se retorna la variable lingüística como una cadena.
    return $conjunto;
  }

  public function fuzzificarApoyoSimulador($datoCuantitativoApoyoSimulador)
  {
    $conjunto = "";
    /*Se determina y almacena los niveles de membresía que la variable nítida
    * alcanzo en cada uno de los conjuntos difusos que la representan.*/
    $this->nivelMembresiaApoyoSimulador($datoCuantitativoApoyoSimulador);
    /*Se determina la posición en donde la variable alcanzo la membresía más
    * alta en su rango de acción y se obtiene como resultado la variable
    * lingüística que la representa con mayor rango de certeza.*/
    $conjunto = $this->apoyoSimulador[$this->posicionMayorNivelMembresia($this->nivelMembApoyoSimulador)];
    //Se retorna la variable lingüística como una cadena.
    return $conjunto;
  }

  public function fuzzificarCantidadMaterialApoyo($datoCuantitativoCantidadMaterialApoyo)
  {
    $conjunto = "";
    /*Se determina y almacena los niveles de membresía que la variable nítida
    * alcanzo en cada uno de los conjuntos difusos que la representan.*/
    $this->nivelMembresiaCantidadMaterialApoyo($datoCuantitativoCantidadMaterialApoyo);
    /*Se determina la posición en donde la variable alcanzo la membresía más
    * alta en su rango de acción y se obtiene como resultado la variable
    * lingüística que la representa con mayor rango de certeza.*/
    $conjunto = $this->cantidadMaterialApoyo[$this->posicionMayorNivelMembresia($this->nivelMembCantidadMaterialApoyo)];
    //Se retorna la variable lingüística como una cadena.
    return $conjunto;
  }

  public function fuzzificarCalidadMaterialApoyo($datoCuantitativoCalidadMaterialApoyo)
  {
    $conjunto = "";
    /*Se determina y almacena los niveles de membresía que la variable nítida
    * alcanzo en cada uno de los conjuntos difusos que la representan.*/
    $this->nivelMembresiaCalidadMaterialApoyo($datoCuantitativoCalidadMaterialApoyo);
    /*Se determina la posición en donde la variable alcanzo la membresía más
    * alta en su rango de acción y se obtiene como resultado la variable
    * lingüística que la representa con mayor rango de certeza.*/
    $conjunto = $this->calidadMaterialApoyo[$this->posicionMayorNivelMembresia($this->nivelMembCalidadMaterialApoyo)];
    //Se retorna la variable lingüística como una cadena.
    return $conjunto;
  }

  public function fuzzificarClaridadMaterialApoyo($datoCuantitativoClaridadMaterialApoyo)
  {
    $conjunto = "";
    /*Se determina y almacena los niveles de membresía que la variable nítida
    * alcanzo en cada uno de los conjuntos difusos que la representan.*/
    $this->nivelMembresiaClaridadMaterialApoyo($datoCuantitativoClaridadMaterialApoyo);
    /*Se determina la posición en donde la variable alcanzo la membresía más
    * alta en su rango de acción y se obtiene como resultado la variable
    * lingüística que la representa con mayor rango de certeza.*/
    $conjunto = $this->claridadMaterialApoyo[$this->posicionMayorNivelMembresia($this->nivelMembClaridadMaterialApoyo)];
    //Se retorna la variable lingüística como una cadena.
    return $conjunto;
  }

  public function fuzzificarCantidadContenido($datoCuantitativoCantidadContenido)
  {
    $conjunto = "";
    /*Se determina y almacena los niveles de membresía que la variable nítida
    * alcanzo en cada uno de los conjuntos difusos que la representan.*/
    $this->nivelMembresiaCantidadContenido($datoCuantitativoCantidadContenido);
    /*Se determina la posición en donde la variable alcanzo la membresía más
    * alta en su rango de acción y se obtiene como resultado la variable
    * lingüística que la representa con mayor rango de certeza.*/
    $conjunto = $this->cantidadContenido[$this->posicionMayorNivelMembresia($this->nivelMembCantidadContenido)];
    //Se retorna la variable lingüística como una cadena.
    return $conjunto;
  }

  public function fuzzificarCalidadContenido($datoCuantitativoCalidadContenido)
  {
    $conjunto = "";
    /*Se determina y almacena los niveles de membresía que la variable nítida
    * alcanzo en cada uno de los conjuntos difusos que la representan.*/
    $this->nivelMembresiaCalidadContenido($datoCuantitativoCalidadContenido);
    /*Se determina la posición en donde la variable alcanzo la membresía más
    * alta en su rango de acción y se obtiene como resultado la variable
    * lingüística que la representa con mayor rango de certeza.*/
    $conjunto = $this->calidadContenido[$this->posicionMayorNivelMembresia($this->nivelMembCalidadContenido)];
    //Se retorna la variable lingüística como una cadena.
    return $conjunto;
  }

  public function fuzzificarClaridadContenido($datoCuantitativoClaridadContenido)
  {
    $conjunto = "";
    /*Se determina y almacena los niveles de membresía que la variable nítida
    * alcanzo en cada uno de los conjuntos difusos que la representan.*/
    $this->nivelMembresiaClaridadContenido($datoCuantitativoClaridadContenido);
    /*Se determina la posición en donde la variable alcanzo la membresía más
    * alta en su rango de acción y se obtiene como resultado la variable
    * lingüística que la representa con mayor rango de certeza.*/
    $conjunto = $this->claridadContenido[$this->posicionMayorNivelMembresia($this->nivelMembClaridadContenido)];
    //Se retorna la variable lingüística como una cadena.
    return $conjunto;
  }

  public function fuzzificarAprendizajeAlumno($datoCuantitativoAprendizajeAlumno)
  {
    $conjunto = "";
    /*Se determina y almacena los niveles de membresía que la variable nítida
    * alcanzo en cada uno de los conjuntos difusos que la representan.*/
    $this->nivelMembresiaAprendizajeAlumno($datoCuantitativoAprendizajeAlumno);
    /*Se determina la posición en donde la variable alcanzo la membresía más
    * alta en su rango de acción y se obtiene como resultado la variable
    *lingüística que la representa con mayor rango de certeza.*/
    $conjunto = $this->aprendizajeAlumno[$this->posicionMayorNivelMembresia($this->nivelMembAprendizajeAlumno)];
    //Se retorna la variable lingüística como una cadena.
    return $conjunto;
  }

  //****************************************************************************


  /*Este método se encarga de realizar una inferencia cualitativa para calcular
  * la variable intermedia ‘SimuladorCualitativo’ a partir de las variables de
  * entrada Dificultad utilización del simulador y Apoyo en el aprendizaje del
  * simulador las cuales previamente se encuentra en sus representaciones
  * difusas correspondientes.*/
  public function inferirInterSimuladorCualitativo($dificUtilSimu, $ApoyoSimu)
  {
    $InterSimulador = "-";
    // Regla de inferencia difusa #1
    if (strcmp($dificUtilSimu, "MuyDificil") == 0 &&
    strcmp($ApoyoSimu, "Mala") == 0) $InterSimulador = "Deficiente";
    else
    // Regla de inferencia difusa #2
    if (strcmp($dificUtilSimu, "MuyDificil") == 0 &&
    strcmp($ApoyoSimu, "Insuficiente") == 0) $InterSimulador = "Deficiente";
    else
    // Regla de inferencia difusa #3
    if (strcmp($dificUtilSimu, "MuyDificil") == 0 &&
    strcmp($ApoyoSimu, "Promedio") == 0) $InterSimulador = "Insuficiente";
    else
    // Regla de inferencia difusa #4
    if (strcmp($dificUtilSimu, "MuyDificil") == 0 &&
    strcmp($ApoyoSimu, "Buena") == 0) $InterSimulador = "Promedio";
    else
    // Regla de inferencia difusa #5
    if (strcmp($dificUtilSimu, "MuyDificil") == 0 &&
    strcmp($ApoyoSimu, "Excelente") == 0) $InterSimulador = "Promedio";
    else
    // Regla de inferencia difusa #6
    if (strcmp($dificUtilSimu, "Dificil") == 0 &&
    strcmp($ApoyoSimu, "Mala") == 0) $InterSimulador = "Deficiente";
    else
    // Regla de inferencia difusa #7
    if (strcmp($dificUtilSimu, "Dificil") == 0 &&
    strcmp($ApoyoSimu, "Insuficiente") == 0) $InterSimulador = "Insuficiente";
    else
    // Regla de inferencia difusa #8
    if (strcmp($dificUtilSimu, "Dificil") == 0 &&
    strcmp($ApoyoSimu, "Promedio") == 0) $InterSimulador = "Insuficiente";
    else
    // Regla de inferencia difusa #9
    if (strcmp($dificUtilSimu, "Dificil") == 0 &&
    strcmp($ApoyoSimu, "Buena") == 0) $InterSimulador = "Promedio";
    else
    // Regla de inferencia difusa #10
    if (strcmp($dificUtilSimu, "Dificil") == 0 &&
    strcmp($ApoyoSimu, "Excelente") == 0) $InterSimulador = "Buena";
    else
    // Regla de inferencia difusa #11
    if (strcmp($dificUtilSimu, "Regular") == 0 &&
    strcmp($ApoyoSimu, "Mala") == 0) $InterSimulador = "Insuficiente";
    else
    // Regla de inferencia difusa #12
    if (strcmp($dificUtilSimu, "Regular") == 0 &&
    strcmp($ApoyoSimu, "Insuficiente") == 0) $InterSimulador = "Insuficiente";
    else
    // Regla de inferencia difusa #13
    if (strcmp($dificUtilSimu, "Regular") == 0 &&
    strcmp($ApoyoSimu, "Promedio") == 0) $InterSimulador = "Promedio";
    else
    // Regla de inferencia difusa #14
    if (strcmp($dificUtilSimu, "Regular") == 0 &&
    strcmp($ApoyoSimu, "Buena") == 0) $InterSimulador = "Buena";
    else
    // Regla de inferencia difusa #15
    if (strcmp($dificUtilSimu, "Regular") == 0 &&
    strcmp($ApoyoSimu, "Excelente") == 0) $InterSimulador = "Buena";
    else
    // Regla de inferencia difusa #16
    if (strcmp($dificUtilSimu, "Facil") == 0 &&
    strcmp($ApoyoSimu, "Mala") == 0) $InterSimulador = "Insuficiente";
    else
    // Regla de inferencia difusa #17
    if (strcmp($dificUtilSimu, "Facil") == 0 &&
    strcmp($ApoyoSimu, "Insuficiente") == 0) $InterSimulador = "Promedio";
    else
    // Regla de inferencia difusa #18
    if (strcmp($dificUtilSimu, "Facil") == 0 &&
    strcmp($ApoyoSimu, "Promedio") == 0) $InterSimulador = "Buena";
    else
    // Regla de inferencia difusa #19
    if (strcmp($dificUtilSimu, "Facil") == 0 &&
    strcmp($ApoyoSimu, "Buena") == 0) $InterSimulador = "Excelente";
    else
    // Regla de inferencia difusa #20
    if (strcmp($dificUtilSimu, "Facil") == 0 &&
    strcmp($ApoyoSimu, "Excelente") == 0) $InterSimulador = "Excelente";
    else
    // Regla de inferencia difusa #21
    if (strcmp($dificUtilSimu, "MuyFacil") == 0 &&
    strcmp($ApoyoSimu, "Mala") == 0) $InterSimulador = "Promedio";
    else
    // Regla de inferencia difusa #22
    if (strcmp($dificUtilSimu, "MuyFacil") == 0 &&
    strcmp($ApoyoSimu, "Insuficiente") == 0) $InterSimulador = "Promedio";
    else
    // Regla de inferencia difusa #23
    if (strcmp($dificUtilSimu, "MuyFacil") == 0 &&
    strcmp($ApoyoSimu, "Promedio") == 0) $InterSimulador = "Buena";
    else
    // Regla de inferencia difusa #24
    if (strcmp($dificUtilSimu, "MuyFacil") == 0 &&
    strcmp($ApoyoSimu, "Buena") == 0) $InterSimulador = "Excelente";
    else
    // Regla de inferencia difusa #25
    if (strcmp($dificUtilSimu, "MuyFacil") == 0 &&
    strcmp($ApoyoSimu, "Excelente") == 0) $InterSimulador = "Excelente";
    else
    $InterSimulador = "Error";
    /* Se retorna el resultado para indicar el conjunto difuso al que pertenece
    * la variable intermedia ‘Califiacion simulador’.*/
    return $InterSimulador;
  }

  /*Este método se encarga de realizar una inferencia cualitativa para calcular
  * la variable intermedia MaterialApoyoCualitativo a partir de las variables de
  * entrada Calidad, Claridad y Cantidad del material de apoyo simulador las
  * cuales previamente se encuentra en sus representaciones difusas
  * correspondientes.*/
  public function inferirInterMaterialApoyoCualitativo($CaliMatApo, $ClarMatApo,
  $CantMatApo)
  {
    $InterCont = "-";
    // Regla de inferencia difusa #1
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #2
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #3
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #4
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #5
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #6
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #7
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #8
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #9
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #10
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #11
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #12
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #13
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #14
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #15
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #16
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #17
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #18
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #19
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    trcmp($CantMatApo, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #20
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #21
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #22
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #23
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #24
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #25
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #26
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #27
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #28
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #29
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #30
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #31
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #32
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #33
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #34
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #35
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #36
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #37
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #38
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #39
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #40
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #41
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #42
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #43
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #44
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #45
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #46
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #47
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #48
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #49
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #50
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #51
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #52
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #53
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #54
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #55
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #56
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #57
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #58
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #59
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #60
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #61
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #62
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #63
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #64
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #65
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #66
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #67
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #68
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #69
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #70
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #71
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #72
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #73
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #74
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #75
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #76
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #77
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #78
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #79
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #80
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #81
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #82
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #83
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #84
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #85
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #86
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #87
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #88
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #89
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #90
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #91
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #92
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #93
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #94
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #95
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #96
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #97
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #98
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #99
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #100
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #101
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #102
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #103
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #104
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #105
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #106
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #107
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #108
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #109
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #110
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #111
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #112
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #113
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #114
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #115
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #116
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #117
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #118
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #119
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #120
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #121
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #122
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #123
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Suficiente") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #124
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Mucho") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #125
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantMatApo, "Demasiado") == 0) $InterCont = "Buena";
    else
    $InterCont = "Error";
    /* Se retorna el resultado para indicar el conjunto difuso al que pertenece
    * la variable intermedia ‘Contenido apoyo materia’.*/
    return $InterCont;
  }

  /*Este método se encarga de realizar una inferencia cualitativa para calcular
  * la variable intermedia ContenidoMateriaCualitativo a partir de las variables de
  * entrada Calidad, Claridad y Cantidad contenido de la materia las
  * cuales previamente se encuentra en sus representaciones difusas
  * correspondientes.*/
  public function inferirInterContenidoMateriaCualitativo($CaliCont, $ClarCont,
  $CantCont)
  {
    $InterCont = "-";
    // Regla de inferencia difusa #1
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #2
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #3
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #4
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #5
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #6
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #7
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #8
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #9
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #10
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #11
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #12
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #13
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #14
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #15
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #16
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #17
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #18
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #19
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #20
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #21
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #22
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #23
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #24
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #25
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #26
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #27
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #28
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #29
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #30
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #31
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #32
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #33
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #34
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #35
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Deficiente";
    else
    // Regla de inferencia difusa #36
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #37
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #38
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #39
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #40
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #41
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #42
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #43
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #44
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #45
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #46
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #47
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #48
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #49
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #50
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #51
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #52
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #53
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #54
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #55
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #56
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #57
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #58
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #59
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #60
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #61
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #62
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #63
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #64
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #65
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #66
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #67
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #68
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #69
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #70
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #71
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #72
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #73
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #74
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #75
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #76
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #77
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #78
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #79
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #80
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #81
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #82
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #83
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #84
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #85
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Insuficiente";
    else
    // Regla de inferencia difusa #86
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #87
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #88
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #89
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #90
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #91
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #92
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #93
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #94
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #95
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #96
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #97
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #98
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #99
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #100
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #101
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #102
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #103
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #104
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #105
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #106
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #107
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #108
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #109
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #110
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Promedio";
    else
    // Regla de inferencia difusa #111
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #112
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #113
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #114
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #115
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #116
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #117
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #118
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #119
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #120
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Buena";
    else
    // Regla de inferencia difusa #121
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #122
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Poco") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #123
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Suficiente") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #124
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Mucho") == 0) $InterCont = "Excelente";
    else
    // Regla de inferencia difusa #125
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Demasiado") == 0) $InterCont = "Buena";
    else
    $InterCont = "Error";
    /* Se retorna el resultado para indicar el conjunto difuso al que pertenece
    *  la variable intermedia Calificación del contenido’.*/
    return $InterCont;
  }

  /*Este método se encarga de realizar una inferencia cualitativa para calcular
  * la variable intermedia CalificacionClaseCualitativo a partir de las variables
  * nivel de aprendizaje y calidad de la clase, las cuales previamente se
  * encuentra en sus representaciones difusas correspondientes.*/
  public function inferirCalificacionClaseCualitativo($nivelAprendizaje,
  $calidadClase)
  {
    $calificacionClase = "-";
    // Regla de inferencia difusa #1
    if (strcmp($nivelAprendizaje, "Deficiente") == 0 &&
    strcmp($calidadClase, "Deficiente") == 0) $calificacionClase = "Deficiente";
    else
    // Regla de inferencia difusa #2
    if (strcmp($nivelAprendizaje, "Deficiente") == 0 &&
    strcmp($calidadClase, "Insuficiente") == 0) $calificacionClase = "Deficiente";
    else
    // Regla de inferencia difusa #3
    if (strcmp($nivelAprendizaje, "Deficiente") == 0 &&
    strcmp($calidadClase, "Promedio") == 0) $calificacionClase = "Insuficiente";
    else
    // Regla de inferencia difusa #4
    if (strcmp($nivelAprendizaje, "Deficiente") == 0 &&
    strcmp($calidadClase, "Buena") == 0) $calificacionClase = "Promedio";
    else
    // Regla de inferencia difusa #5
    if (strcmp($nivelAprendizaje, "Deficiente") == 0 &&
    strcmp($calidadClase, "Excelente") == 0) $calificacionClase = "Promedio";
    else
    // Regla de inferencia difusa #6
    if (strcmp($nivelAprendizaje, "Insuficiente") == 0 &&
    strcmp($calidadClase, "Deficiente") == 0) $calificacionClase = "Deficiente";
    else
    // Regla de inferencia difusa #7
    if (strcmp($nivelAprendizaje, "Insuficiente") == 0 &&
    strcmp($calidadClase, "Insuficiente") == 0) $calificacionClase = "Deficiente";
    else
    // Regla de inferencia difusa #8
    if (strcmp($nivelAprendizaje, "Insuficiente") == 0 &&
    strcmp($calidadClase, "Promedio") == 0) $calificacionClase = "Insuficiente";
    else
    // Regla de inferencia difusa #9
    if (strcmp($nivelAprendizaje, "Insuficiente") == 0 &&
    strcmp($calidadClase, "Buena") == 0) $calificacionClase = "Promedio";
    else
    // Regla de inferencia difusa #10
    if (strcmp($nivelAprendizaje, "Insuficiente") == 0 &&
    strcmp($calidadClase, "Excelente") == 0) $calificacionClase = "Promedio";
    else
    // Regla de inferencia difusa #11
    if (strcmp($nivelAprendizaje, "Promedio") == 0 &&
    strcmp($calidadClase, "Deficiente") == 0) $calificacionClase = "Insuficiente";
    else
    // Regla de inferencia difusa #12
    if (strcmp($nivelAprendizaje, "Promedio") == 0 &&
    strcmp($calidadClase, "Insuficiente") == 0) $calificacionClase = "Insuficiente";
    else
    // Regla de inferencia difusa #13
    if (strcmp($nivelAprendizaje, "Promedio") == 0 &&
    strcmp($calidadClase, "Promedio") == 0) $calificacionClase = "Promedio";
    else
    // Regla de inferencia difusa #14
    if (strcmp($nivelAprendizaje, "Promedio") == 0 &&
    strcmp($calidadClase, "Buena") == 0) $calificacionClase = "Buena";
    else
    // Regla de inferencia difusa #15
    if (strcmp($nivelAprendizaje, "Promedio") == 0 &&
    strcmp($calidadClase, "Excelente") == 0) $calificacionClase = "Buena";
    else
    // Regla de inferencia difusa #16
    if (strcmp($nivelAprendizaje, "Buena") == 0 &&
    strcmp($calidadClase, "Deficiente") == 0) $calificacionClase = "Promedio";
    else
    // Regla de inferencia difusa #17
    if (strcmp($nivelAprendizaje, "Buena") == 0 &&
    strcmp($calidadClase, "Insuficiente") == 0) $calificacionClase = "Promedio";
    else
    // Regla de inferencia difusa #18
    if (strcmp($nivelAprendizaje, "Buena") == 0 &&
    strcmp($calidadClase, "Promedio") == 0) $calificacionClase = "Buena";
    else
    // Regla de inferencia difusa #19
    if (strcmp($nivelAprendizaje, "Buena") == 0 &&
    strcmp($calidadClase, "Buena") == 0) $calificacionClase = "Excelente";
    else
    // Regla de inferencia difusa #20
    if (strcmp($nivelAprendizaje, "Buena") == 0 &&
    strcmp($calidadClase, "Excelente") == 0) $calificacionClase = "Excelente";
    else
    // Regla de inferencia difusa #21
    if (strcmp($nivelAprendizaje, "Excelente") == 0 &&
    strcmp($calidadClase, "Deficiente") == 0) $calificacionClase = "Promedio";
    else
    // Regla de inferencia difusa #22
    if (strcmp($nivelAprendizaje, "Excelente") == 0 &&
    strcmp($calidadClase, "Insuficiente") == 0) $calificacionClase = "Promedio";
    else
    // Regla de inferencia difusa #23
    if (strcmp($nivelAprendizaje, "Excelente") == 0 &&
    strcmp($calidadClase, "Promedio") == 0) $calificacionClase = "Buena";
    else
    // Regla de inferencia difusa #24
    if (strcmp($nivelAprendizaje, "Excelente") == 0 &&
    strcmp($calidadClase, "Buena") == 0) $calificacionClase = "Excelente";
    else
    // Regla de inferencia difusa #25
    if (strcmp($nivelAprendizaje, "Excelente") == 0 &&
    strcmp($calidadClase, "Excelente") == 0) $calificacionClase = "Excelente";
    else
    $calificacionClase = "Error";
    /* Se retorna el resultado para indicar el conjunto difuso al que pertenece
    * la variable de salida ‘Calificación de la clase’.*/
    return $calificacionClase;
  }

  /*Este método se encarga de realizar una inferencia cualitativa para calcular
  * la variable intermedia CalidadClaseCualitativo a partir de las variables
  * interSimu, interMatApo y interCont, las cuales previamente se encuentra en
  * sus representaciones difusas correspondientes.*/
  public function inferirInterCalidadClaseCualitativo($interSimu, $interMatApo,
  $interCont)
  {
    $InterCalClase = "-";
    // Regla de inferencia difusa #1
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #2
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #3
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #4
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #5
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #6
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #7
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #8
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #9
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #10
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #11
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #12
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #13
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #14
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #15
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #16
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #17
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #18
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #19
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #20
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #21
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #22
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #23
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #24
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #25
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #26
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #27
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #28
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #29
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #30
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #31
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #32
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #33
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #34
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #35
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #36
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #37
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #38
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #39
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #40
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #41
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #42
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #43
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #44
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #45
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #46
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #47
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #48
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #49
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #50
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #51
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #52
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #53
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #54
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #55
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #56
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #57
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #58
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #59
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #60
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #61
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #62
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #63
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #64
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #65
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #66
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #67
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #68
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #69
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #70
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #71
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #72
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #73
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #74
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #75
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Bueno";
    else
    // Regla de inferencia difusa #76
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #77
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #78
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #79
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #80
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #81
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Deficiente";
    else
    // Regla de inferencia difusa #82
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #83
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #84
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #85
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #86
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #87
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #88
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #89
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #90
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #91
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #92
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #93
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #94
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #95
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Excelente";
    else
    // Regla de inferencia difusa #96
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #97
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Bueno";
    else
    // Regla de inferencia difusa #98
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #99
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Excelente";
    else
    // Regla de inferencia difusa #100
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Excelente";
    else
    // Regla de inferencia difusa #101
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #102
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #103
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #104
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #105
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #106
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Insuficiente";
    else
    // Regla de inferencia difusa #107
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #108
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #109
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #110
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #111
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #112
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #113
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #114
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #115
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Excelente";
    else
    // Regla de inferencia difusa #116
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #117
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #118
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #119
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Excelente";
    else
    // Regla de inferencia difusa #120
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Excelente";
    else
    // Regla de inferencia difusa #121
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Deficiente") == 0) $InterCalClase = "Promedio";
    else
    // Regla de inferencia difusa #122
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0) $InterCalClase = "Buena";
    else
    // Regla de inferencia difusa #1230
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Promedio") == 0) $InterCalClase = "Excelente";
    else
    // Regla de inferencia difusa #124
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Buena") == 0) $InterCalClase = "Excelente";
    else
    // Regla de inferencia difusa #125
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Excelente") == 0) $InterCalClase = "Excelente";
    else
    $InterCalClase = "Error";
    /* Se retorna el resultado para indicar el conjunto difuso al que pertenece
    * la variable intermedia ‘Calidad de la clase’.*/
    return $InterCalClase;
  }

  //****************************************************************************


  public function inferirInterSimuladorCuantitativo($dificUtilSimu, $ApoyoSimu)
  {
    $nivMemDificUtilSimu = $this->nivelMembDificultadUtilSimualdor[$this->posicionMayorNivelMembresia($this->nivelMembDificultadUtilSimualdor)];
    $nivMemApoyoSimu = $this->nivelMembApoyoSimulador[$this->posicionMayorNivelMembresia($this->nivelMembApoyoSimulador)];

    /* El cálculo se ha colocado una sola vez puesto que es estructuralmente el
    * mismo para todas las reglas. Si fuera distinto  en las reglas, cada una
    * debería llevarlo.
    * Se calcula el nivel de membresía de la variable de salida.*/
    $nivMemInterSimulador = BiblioFuzzy::Minimo($nivMemDificUtilSimu, $nivMemApoyoSimu);

    // Regla de inferencia difusa #1
    if (strcmp($dificUtilSimu, "MuyDificil") == 0 &&
    strcmp($ApoyoSimu, "Mala") == 0)
    $this->nivelMembInterSimulador[0] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #2
    if (strcmp($dificUtilSimu, "MuyDificil") == 0 &&
    strcmp($ApoyoSimu, "Insuficiente") == 0)
    $this->nivelMembInterSimulador[0] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #3
    if (strcmp($dificUtilSimu, "MuyDificil") == 0 &&
    strcmp($ApoyoSimu, "Promedio") == 0)
    $this->nivelMembInterSimulador[1] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #4
    if (strcmp($dificUtilSimu, "MuyDificil") == 0 &&
    strcmp($ApoyoSimu, "Buena") == 0)
    $this->nivelMembInterSimulador[2] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #5
    if (strcmp($dificUtilSimu, "MuyDificil") == 0 &&
    strcmp($ApoyoSimu, "Excelente") == 0)
    $this->nivelMembInterSimulador[2] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #6
    if (strcmp($dificUtilSimu, "Dificil") == 0 &&
    strcmp($ApoyoSimu, "Mala") == 0)
    $this->nivelMembInterSimulador[0] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #7
    if (strcmp($dificUtilSimu, "Dificil") == 0 &&
    strcmp($ApoyoSimu, "Insuficiente") == 0)
    $this->nivelMembInterSimulador[1] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #8
    if (strcmp($dificUtilSimu, "Dificil") == 0 &&
    strcmp($ApoyoSimu, "Promedio") == 0)
    $this->nivelMembInterSimulador[1] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #9
    if (strcmp($dificUtilSimu, "Dificil") == 0 &&
    strcmp($ApoyoSimu, "Buena") == 0)
    $this->nivelMembInterSimulador[2] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #10
    if (strcmp($dificUtilSimu, "Dificil") == 0 &&
    strcmp($ApoyoSimu, "Excelente") == 0)
    $this->nivelMembInterSimulador[3] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #11
    if (strcmp($dificUtilSimu, "Regular") == 0 &&
    strcmp($ApoyoSimu, "Mala") == 0)
    $this->nivelMembInterSimulador[1] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #12
    if (strcmp($dificUtilSimu, "Regular") == 0 &&
    strcmp($ApoyoSimu, "Insuficiente") == 0)
    $this->nivelMembInterSimulador[1] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #13
    if (strcmp($dificUtilSimu, "Regular") == 0 &&
    strcmp($ApoyoSimu, "Promedio") == 0)
    $this->nivelMembInterSimulador[2] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #14
    if (strcmp($dificUtilSimu, "Regular") == 0 &&
    strcmp($ApoyoSimu, "Buena") == 0)
    $this->nivelMembInterSimulador[3] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #15
    if (strcmp($dificUtilSimu, "Regular") == 0 &&
    strcmp($ApoyoSimu, "Excelente") == 0)
    $this->nivelMembInterSimulador[3] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #16
    if (strcmp($dificUtilSimu, "Facil") == 0 &&
    strcmp($ApoyoSimu, "Mala") == 0)
    $this->nivelMembInterSimulador[1] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #17
    if (strcmp($dificUtilSimu, "Facil") == 0 &&
    strcmp($ApoyoSimu, "Insuficiente") == 0)
    $this->nivelMembInterSimulador[2] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #18
    if (strcmp($dificUtilSimu, "Facil") == 0 &&
    strcmp($ApoyoSimu, "Promedio") == 0)
    $this->nivelMembInterSimulador[3] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #19
    if (strcmp($dificUtilSimu, "Facil") == 0 &&
    strcmp($ApoyoSimu, "Buena") == 0)
    $this->nivelMembInterSimulador[4] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #20
    if (strcmp($dificUtilSimu, "Facil") == 0 &&
    strcmp($ApoyoSimu, "Excelente") == 0)
    $this->nivelMembInterSimulador[4] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #21
    if (strcmp($dificUtilSimu, "MuyFacil") == 0 &&
    strcmp($ApoyoSimu, "Mala") == 0)
    $this->nivelMembInterSimulador[2] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #22
    if (strcmp($dificUtilSimu, "MuyFacil") == 0 &&
    strcmp($ApoyoSimu, "Insuficiente") == 0)
    $this->nivelMembInterSimulador[2] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #23
    if (strcmp($dificUtilSimu, "MuyFacil") == 0 &&
    strcmp($ApoyoSimu, "Promedio") == 0)
    $this->nivelMembInterSimulador[3] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #24
    if (strcmp($dificUtilSimu, "MuyFacil") == 0 &&
    strcmp($ApoyoSimu, "Buena") == 0)
    $this->nivelMembInterSimulador[4] = $nivMemInterSimulador;
    else
    // Regla de inferencia difusa #25
    if (strcmp($dificUtilSimu, "MuyFacil") == 0 &&
    strcmp($ApoyoSimu, "Excelente") == 0)
    $this->nivelMembInterSimulador[4] = $nivMemInterSimulador;
    else
    $this->$nivelMembInterSimulador[0] = -1;
    //$this->imprimirNivelMembresiaMayor("nivelMembInterSimulador: ", $this->nivelMembInterSimulador);
    return $this->nivelMembInterSimulador[$this->posicionMayorNivelMembresia($this->nivelMembInterSimulador)];
  }

  public function inferirInterMaterialApoyoCuantitativo($CaliMatApo, $ClarMatApo, $CantApo)
  {
    $nivMemCalMatApo = $this->nivelMembCalidadMaterialApoyo[$this->posicionMayorNivelMembresia($this->nivelMembCalidadMaterialApoyo)];
    $nivMemClarMatApo= $this->nivelMembClaridadMaterialApoyo[$this->posicionMayorNivelMembresia($this->nivelMembClaridadMaterialApoyo)];
    $nivMemCantMatApo= $this->nivelMembCantidadMaterialApoyo[$this->posicionMayorNivelMembresia($this->nivelMembCantidadMaterialApoyo)];

    /* El cálculo se ha colocado una sola vez puesto que es estructuralmente el
    * mismo para todas las reglas. Si fuera distinto  en las reglas, cada una
    * debería llevarlo.
    * Se calcula el nivel de membresía de la variable de salida.*/
    $nivMemInterMaterialApoyo = BiblioFuzzy::Minimo(BiblioFuzzy::Minimo($nivMemCalMatApo, $nivMemClarMatApo), $nivMemCantMatApo);

    // Regla de inferencia difusa #1
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #2
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #3
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #4
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #5
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #6
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #7
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #8
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #9
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #10
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #11
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #12
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #13
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #14
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #15
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #16
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #17
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #18
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #19
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #20
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #21
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #22
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #23
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #24
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #25
    if (strcmp($CaliMatApo, "Mala") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #26
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #27
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #28
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #29
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #30
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #31
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #32
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #33
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #34
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #35
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[0] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #36
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #37
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #38
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #39
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #40
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #41
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #42
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #43
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #44
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #45
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #46
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #47
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #48
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #49
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #50
    if (strcmp($CaliMatApo, "Insuficiente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #51
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #52
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #53
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #54
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #55
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #56
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #57
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #58
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #59
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #60
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #61
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #62
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #63
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #64
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #65
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #66
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #67
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #68
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #69
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #70
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #71
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #72
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #73
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #74
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #75
    if (strcmp($CaliMatApo, "Promedio") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #76
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #77
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #78
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #79
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #80
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #81
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #82
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #83
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #84
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #85
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[1] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #86
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #87
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #88
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #89
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #90
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #91
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #92
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #93
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #94
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #95
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #96
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #97
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #98
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #99
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #100
    if (strcmp($CaliMatApo, "Buena") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #101
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #102
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #103
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #104
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #105
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "NadaClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #106
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #107
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #108
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #109
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #110
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "PocoClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[2] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #111
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #112
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #113
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #114
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #115
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Claro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #116
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #117
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #118
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Suficiente") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #119
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Mucho") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #120
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "MuyClaro") == 0 &&
    strcmp($CantApo, "Demasiado") == 0)
    $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #121
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "MuyPoco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #122
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Poco") == 0)
    $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #123
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Suficiente") == 0) $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #124
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Mucho") == 0) $this->nivelMembInterMaterialApoyo[4] = $nivMemInterMaterialApoyo;
    else
    // Regla de inferencia difusa #125
    if (strcmp($CaliMatApo, "Excelente") == 0 &&
    strcmp($ClarMatApo, "Clarisimo") == 0 &&
    strcmp($CantApo, "Demasiado") == 0) $this->nivelMembInterMaterialApoyo[3] = $nivMemInterMaterialApoyo;
    else
    $this->nivelMembInterMaterialApoyo[0] = -1;
    //$this->imprimirNivelMembresiaMayor("nivelMembInterSimulador: ", $this->nivelMembInterSimulador);
    return $this->nivelMembInterMaterialApoyo[$this->posicionMayorNivelMembresia($this->nivelMembInterMaterialApoyo)];
  }

  public function inferirInterContenidoCuantitativo($CaliCont, $ClarCont, $CantCont)
  {
    $nivMemCalCont = $this->nivelMembCalidadContenido[$this->posicionMayorNivelMembresia($this->nivelMembCalidadContenido)];
    $nivMemClarCont= $this->nivelMembClaridadContenido[$this->posicionMayorNivelMembresia($this->nivelMembClaridadContenido)];
    $nivMemCantCont= $this->nivelMembCantidadContenido[$this->posicionMayorNivelMembresia($this->nivelMembCantidadContenido)];

    /* El cálculo se ha colocado una sola vez puesto que es estructuralmente el
    * mismo para todas las reglas. Si fuera distinto  en las reglas, cada una
    * debería llevarlo.
    * Se calcula el nivel de membresía de la variable de salida.*/
    $nivMemInterContenido = BiblioFuzzy::Minimo(BiblioFuzzy::Minimo($nivMemCalCont, $nivMemClarCont), $nivMemCantCont);

    // Regla de inferencia difusa #1
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #2
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #3
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #4
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #5
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #6
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #7
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #8
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #9
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #10
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #11
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #12
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #13
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #14
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #15
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #16
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #17
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #18
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #19
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #20
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #21
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #22
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #23
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #24
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #25
    if (strcmp($CaliCont, "Mala") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #26
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #27
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #28
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #29
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #30
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #31
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #32
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #33
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #34
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #35
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[0] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #36
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #37
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #38
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #39
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #40
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #41
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #42
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #43
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #44
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #45
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #46
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #47
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #48
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #49
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #50
    if (strcmp($CaliCont, "Insuficiente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #51
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #52
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #53
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #54
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #55
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #56
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #57
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #58
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #59
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #60
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #61
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #62
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #63
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #64
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #65
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #66
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #67
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #68
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #69
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #70
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #71
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #72
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #73
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #74
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #75
    if (strcmp($CaliCont, "Promedio") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #76
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #77
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #78
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #79
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #80
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #81
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #82
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #83
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #84
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #85
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[1] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #86
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #87
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #88
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #89
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #90
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #91
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #92
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #93
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #94
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #95
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #96
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #97
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #98
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #99
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #100
    if (strcmp($CaliCont, "Buena") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #101
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #102
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #103
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #104
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #105
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "NadaClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #106
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #107
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #108
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #109
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #110
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "PocoClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[2] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #111
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #112
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #113
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #114
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #115
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Claro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #116
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #117
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #118
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #119
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #120
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "MuyClaro") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #121
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "MuyPoco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #122
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Poco") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #123
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Suficiente") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #124
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Mucho") == 0)
    $this->nivelMembInterContMateria[4] = $nivMemInterContenido;
    else
    // Regla de inferencia difusa #125
    if (strcmp($CaliCont, "Excelente") == 0 &&
    strcmp($ClarCont, "Clarisimo") == 0 &&
    strcmp($CantCont, "Demasiado") == 0)
    $this->nivelMembInterContMateria[3] = $nivMemInterContenido;
    else
    $this->$nivelMembInterContMateria[0] = -1;
    //$this->imprimirNivelMembresiaMayor("nivelMembInterContMateria: ", $this->nivelMembInterContMateria);
    return $this->nivelMembInterContMateria[$this->posicionMayorNivelMembresia($this->nivelMembInterContMateria)];
  }

  public function inferirInterCalidadClaseCuantitativo($interSimu, $interMatApo, $interCont)
  {
    $nivMemDInterSimu = $this->nivelMembInterSimulador[$this->posicionMayorNivelMembresia($this->nivelMembInterSimulador)];
    $nivMemInterMatApo = $this->nivelMembInterMaterialApoyo[$this->posicionMayorNivelMembresia($this->nivelMembInterMaterialApoyo)];
    $nivMemInterContMat = $this->nivelMembInterContMateria[$this->posicionMayorNivelMembresia($this->nivelMembInterContMateria)];

    // El cálculo se ha colocado una sola vez puesto que es estructuralmente el mismo para todas las reglas. Si fuera distinto  en las reglas, cada una debería llevarlo.
    // Se calcula el nivel de membresía de la variable de salida.
    $nivMemInterCaliClase = BiblioFuzzy::Minimo(BiblioFuzzy::Minimo($nivMemDInterSimu, $nivMemInterMatApo),$nivMemInterContMat);

    // Regla de inferencia difusa #1
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #2
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #3
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #4
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #5
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #6
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #7
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #8
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #9
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #10
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #11
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #12
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #13
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #14
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #15
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #16
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #17
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #18
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #19
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #20
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #21
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #22
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #23
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #24
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #25
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #26
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #27
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #28
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #29
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #30
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #31
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #32
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #33
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #34
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #35
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #36
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #37
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #38
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #39
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #40
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #41
    if (strcmp($interSimu, "Deficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #42
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #43
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #44
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #45
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #46
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #47
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #48
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #49
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #50
    if (strcmp($interSimu, "Insuficiente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #51
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #52
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #53
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #54
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #55
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #56
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #57
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #58
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #59
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #60
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #61
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #62
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #63
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #64
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #65
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #66
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #67
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #68
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #69
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #70
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #71
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #72
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #73
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #74
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #75
    if (strcmp($interSimu, "Promedio") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $InterCalClase = "Bueno";
    else
    // Regla de inferencia difusa #76
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #77
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #78
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #79
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #80
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #81
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[0] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #82
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #83
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #84
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #85
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #86
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #87
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #88
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #89
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #90
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #91
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #92
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #93
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #94
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #95
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[4] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #96
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #97
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $InterCalClase = "Bueno";
    else
    // Regla de inferencia difusa #98
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #99
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[4] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #100
    if (strcmp($interSimu, "Buena") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[4] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #101
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #102
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #103
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #104
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #105
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Deficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #106
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[1] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #107
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #108
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #109
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #110
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Insuficiente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #111
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #112
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #113
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #114
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #115
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Promedio") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[4] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #116
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #117
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #118
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #119
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[4] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #120
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Buena") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[4] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #121
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Deficiente") == 0)
    $this->nivelMembInterCalClase[2] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #122
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Insuficiente") == 0)
    $this->nivelMembInterCalClase[3] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #1230
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Promedio") == 0)
    $this->nivelMembInterCalClase[4] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #124
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Buena") == 0)
    $this->nivelMembInterCalClase[4] = $nivMemInterCaliClase;
    else
    // Regla de inferencia difusa #125
    if (strcmp($interSimu, "Excelente") == 0 &&
    strcmp($interMatApo, "Excelente") == 0 &&
    strcmp($interCont, "Excelente") == 0)
    $this->nivelMembInterCalClase[4] = $nivMemInterCaliClase;
    else
    $this->nivelMembInterCalClase[0] = -1;
    //$this->imprimirNivelMembresiaMayor("nivelMembInterCalClase: ", $this->nivelMembInterCalClase);
    return $this->nivelMembInterCalClase[$this->posicionMayorNivelMembresia($this->nivelMembInterCalClase)];
  }

  public function inferirCalificacionClaseCuantitativo($nivelAprendizaje, $calidadClase)
  {
    $nivMemApren = $this->nivelMembAprendizajeAlumno[$this->posicionMayorNivelMembresia($this->nivelMembAprendizajeAlumno)];
    $nivMemCalClase = $this->nivelMembInterCalClase[$this->posicionMayorNivelMembresia($this->nivelMembInterCalClase)];

    $nivMemCalificaClase = BiblioFuzzy::Minimo($nivMemApren, $nivMemCalClase);
    // Regla de inferencia difusa #1
    if (strcmp($nivelAprendizaje, "Deficiente") == 0 &&
    strcmp($calidadClase, "Deficiente") == 0)
    $this->nivelMembCalificacionClase[0] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #2
    if (strcmp($nivelAprendizaje, "Deficiente") == 0 &&
    strcmp($calidadClase, "Insuficiente") == 0)
    $this->nivelMembCalificacionClase[0] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #3
    if (strcmp($nivelAprendizaje, "Deficiente") == 0 &&
    strcmp($calidadClase, "Promedio") == 0)
    $this->nivelMembCalificacionClase[1] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #4
    if (strcmp($nivelAprendizaje, "Deficiente") == 0 &&
    strcmp($calidadClase, "Buena") == 0)
    $this->nivelMembCalificacionClase[2] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #5
    if (strcmp($nivelAprendizaje, "Deficiente") == 0 &&
    strcmp($calidadClase, "Excelente") == 0)
    $this->nivelMembCalificacionClase[2] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #6
    if (strcmp($nivelAprendizaje, "Insuficiente") == 0 &&
    strcmp($calidadClase, "Deficiente") == 0)
    $this->nivelMembCalificacionClase[0] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #7
    if (strcmp($nivelAprendizaje, "Insuficiente") == 0 &&
    strcmp($calidadClase, "Insuficiente") == 0)
    $this->nivelMembCalificacionClase[0] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #8
    if (strcmp($nivelAprendizaje, "Insuficiente") == 0 &&
    strcmp($calidadClase, "Promedio") == 0)
    $this->nivelMembCalificacionClase[1] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #9
    if (strcmp($nivelAprendizaje, "Insuficiente") == 0 &&
    strcmp($calidadClase, "Buena") == 0)
    $this->nivelMembCalificacionClase[2] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #10
    if (strcmp($nivelAprendizaje, "Insuficiente") == 0 &&
    strcmp($calidadClase, "Excelente") == 0)
    $this->nivelMembCalificacionClase[2] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #11
    if (strcmp($nivelAprendizaje, "Promedio") == 0 &&
    strcmp($calidadClase, "Deficiente") == 0)
    $this->nivelMembCalificacionClase[1] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #12
    if (strcmp($nivelAprendizaje, "Promedio") == 0 &&
    strcmp($calidadClase, "Insuficiente") == 0)
    $this->nivelMembCalificacionClase[1] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #13
    if (strcmp($nivelAprendizaje, "Promedio") == 0 &&
    strcmp($calidadClase, "Promedio") == 0)
    $this->nivelMembCalificacionClase[2] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #14
    if (strcmp($nivelAprendizaje, "Promedio") == 0 &&
    strcmp($calidadClase, "Buena") == 0)
    $this->nivelMembCalificacionClase[3] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #15
    if (strcmp($nivelAprendizaje, "Promedio") == 0 &&
    strcmp($calidadClase, "Excelente") == 0)
    $this->nivelMembCalificacionClase[3] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #16
    if (strcmp($nivelAprendizaje, "Buena") == 0 &&
    strcmp($calidadClase, "Deficiente") == 0)
    $this->nivelMembCalificacionClase[2] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #17
    if (strcmp($nivelAprendizaje, "Buena") == 0 &&
    strcmp($calidadClase, "Insuficiente") == 0)
    $this->nivelMembCalificacionClase[2] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #18
    if (strcmp($nivelAprendizaje, "Buena") == 0 &&
    strcmp($calidadClase, "Promedio") == 0)
    $this->nivelMembCalificacionClase[3] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #19
    if (strcmp($nivelAprendizaje, "Buena") == 0 &&
    strcmp($calidadClase, "Buena") == 0)
    $this->nivelMembCalificacionClase[4] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #20
    if (strcmp($nivelAprendizaje, "Buena") == 0 &&
    strcmp($calidadClase, "Excelente") == 0)
    $this->nivelMembCalificacionClase[4] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #21
    if (strcmp($nivelAprendizaje, "Excelente") == 0 &&
    strcmp($calidadClase, "Deficiente") == 0)
    $this->nivelMembCalificacionClase[2] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #22
    if (strcmp($nivelAprendizaje, "Excelente") == 0 &&
    strcmp($calidadClase, "Insuficiente") == 0)
    $this->nivelMembCalificacionClase[2] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #23
    if (strcmp($nivelAprendizaje, "Excelente") == 0 &&
    strcmp($calidadClase, "Promedio") == 0)
    $this->nivelMembCalificacionClase[3] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #24
    if (strcmp($nivelAprendizaje, "Excelente") == 0 &&
    strcmp($calidadClase, "Buena") == 0)
    $this->nivelMembCalificacionClase[4] = $nivMemCalificaClase;
    else
    // Regla de inferencia difusa #25
    if (strcmp($nivelAprendizaje, "Excelente") == 0 &&
    strcmp($calidadClase, "Excelente") == 0)
    $this->nivelMembCalificacionClase[4] = $nivMemCalificaClase;
    else
    $this->nivelMembCalificacionClase[0] = -1;
    //$this->imprimirNivelMembresiaMayor("%%%%%%%%%%%%%%%%%%%%%%55nivelMembCalificacionClase: ", $this->nivelMembCalificacionClase);
    return $this->nivelMembCalificacionClase[$this->posicionMayorNivelMembresia($this->nivelMembCalificacionClase)];
  }

  //****************************************************************************

  /* Con el fin de realizar alguna respuesta de control, es posible defuzzificar
  * la respuesta difusa que el sistema produce, hay que con defuzzificar nos
  * referimos al proceso de obtener un valor cuantificable en Lógica clásica,
  * dados conjuntos difusos y sus correspondientes grados de membresía. Es el
  * proceso que transforma un conjunto difuso a un conjunto clásico.
  * Este método utiliza la estrategia propuesta por  Michio Sugeno, el cual
  * consiste en que los valores 20, 40, 60, etc. son colocados como un Singleton.
  * Es un valor representativo del conjunto difuso observado.
  */
  public function desfuzzificarProbabilidad($calClase, $nivCertProbabilidad)
  {
    switch ($calClase)
    {
      case "Deficiente": return $nivCertProbabilidad * 20;
      case "Insuficiente": return $nivCertProbabilidad * 40;
      case "Promedio": return $nivCertProbabilidad * 60;
      case "Buena": return $nivCertProbabilidad * 80;
      case "Excelente": return $nivCertProbabilidad * 100;
    }
    return 0.0;
  }

  //****************************************************************************

  /*En este método se realiza la inferencia difusa a partir de las variables de
  * entrada para optener las variables de salida.*/
  public function inferir($dificulSimuNitido, $apoyoSimuNitido, $CalMatApoNitido,
  $ClarMatApoNitido, $CantMatApoNitido, $CalContNitido,
  $ClarContNitido, $CantContNitido, $nivelAprendizajeNitido,
  $mostrarSalidas)
  {
    if($mostrarSalidas==true){
      echo "\n************************* Variables de entrada
      *************************<br/>";
      echo "[Dificultad utilizar simulador: {$dificulSimuNitido},
      Apoyo Simulador: {$apoyoSimuNitido} ]\n<br/>";
      echo "[Calidad material apoyo: {$CalMatApoNitido},
      Claridad material apoyo: {$ClarMatApoNitido},
      Cantidad material apoyo: {$CantMatApoNitido} ]\n<br/>";
      echo "[Calidad contenido: {$CalContNitido},
      Claridad contenido: {$ClarContNitido},
      Cantidad contenido: {$nivelAprendizajeNitido} ]\n<br/>";
      echo "[Nivel Aprendizaje: {$nivelAprendizajeNitido}]\n<br/>";
    }
    if($mostrarSalidas==true){
      echo "************************* Niveles de membresía de los datos nítidos
      en los conjuntos difusos *************************<br/>";
    }
    $dificulSimuDifuso = $this->fuzzificarDificiltadUtilSimulador($dificulSimuNitido);
    $apoyoSimuDifuso = $this->fuzzificarApoyoSimulador($apoyoSimuNitido);
    $CalMatApoDifuso = $this->fuzzificarCalidadMaterialApoyo($CalMatApoNitido);
    $ClarMatApoDifuso = $this->fuzzificarClaridadMaterialApoyo($ClarMatApoNitido);
    $CantMatApoDifuso = $this->fuzzificarCantidadMaterialApoyo($CantMatApoNitido);
    $CalContDifuso = $this->fuzzificarCalidadContenido($CalContNitido);
    $ClarContDifuso = $this->fuzzificarClaridadContenido($ClarContNitido);
    $CantContDifuso = $this->fuzzificarCantidadContenido($CantContNitido);
    $nivelAprendizajeDifuso = $this->fuzzificarAprendizajeAlumno($nivelAprendizajeNitido);

    if($mostrarSalidas==true){
      echo "\n<br/>";
      echo "************************* Datos nítidos y correspondencia difusa
      *************************\n<br/>";
      echo "Para dificulSimu = {$dificulSimuNitido},
      Corresponde: {$dificulSimuDifuso}\n<br/>";
      echo "Para apoyoSimu = {$apoyoSimuNitido},
      Corresponde: {$apoyoSimuDifuso}\n<br/>";
      echo "Para CalMatApo = {$CalMatApoNitido},
      Corresponde: {$CalMatApoDifuso}\n<br/>";
      echo "Para ClarMatApo = {$ClarMatApoNitido},
      Corresponde: {$ClarMatApoDifuso}\n<br/>";
      echo "Para CantMatApo = {$CantMatApoNitido},
      Corresponde: {$CantMatApoDifuso}\n<br/>";
      echo "Para CalCont = {$CalContNitido},
      Corresponde: {$CalContDifuso}\n<br/>";
      echo "Para ClarCont = {$ClarContNitido},
      Corresponde: {$ClarContDifuso}\n<br/>";
      echo "Para CantCont = {$CantContNitido},
      Corresponde: {$CantContDifuso}\n<br/>";
      echo "Para nivelAprendizaje = {$nivelAprendizajeNitido},
      Corresponde: {$nivelAprendizajeDifuso}\n<br/>";
    }

    // Realizar inferencia difusa cualitativa a partir de valores difusos calculados
    $interSimuladorDifuso =
    $this->inferirInterSimuladorCualitativo($dificulSimuDifuso, $apoyoSimuDifuso);
    $interMaterialApoyoDifuso =
    $this->inferirInterMaterialApoyoCualitativo($CalMatApoDifuso, $ClarMatApoDifuso,
    $CantMatApoDifuso);
    $interContenidoClaseDifuso =
    $this->inferirInterContenidoMateriaCualitativo($CalContDifuso, $ClarContDifuso,
    $CantContDifuso);
    $interCalidadClaseDifuso =
    $this->inferirInterCalidadClaseCualitativo($interSimuladorDifuso,
    $interMaterialApoyoDifuso, $interContenidoClaseDifuso);
    $calificacionClaseDifuso =
    $this->inferirCalificacionClaseCualitativo($nivelAprendizajeDifuso,
    $interCalidadClaseDifuso);
    // Realizar inferencia difusa cuantitativa a partir de valores difusos calculados
    $interSimuladorNitido =
    $this->inferirInterSimuladorCuantitativo($dificulSimuDifuso, $apoyoSimuDifuso);
    $interMatApoNitido =
    $this->inferirInterMaterialApoyoCuantitativo($CalMatApoDifuso,
    $ClarMatApoDifuso, $CantMatApoDifuso);
    $interContNitido =
    $this->inferirInterContenidoCuantitativo($CalContDifuso, $ClarContDifuso,
    $CantContDifuso);
    $interCaliClaseNitido =
    $this->inferirInterCalidadClaseCuantitativo($interSimuladorDifuso,
    $interMaterialApoyoDifuso, $interContenidoClaseDifuso);
    if($mostrarSalidas==true){
      // Notificar en consola resultados de la Inferencia Difusa Cualitativa y Cuantitativa de la sección de codigo anterior.
      echo "\n<br/>";
      echo "************************* Correspondencia difusa para las variables
      intermedias' *************************\n<br/>";
      echo "Variable intermedia interSimuladorDifuso: {$interSimuladorDifuso},
      Con un nivel de certeza de: {$interSimuladorNitido}<br/>";
      echo "Variable intermedia interMaterialApoyoDifuso : {$interMaterialApoyoDifuso},
      Con un nivel de certeza de: {$interMatApoNitido}<br/>";
      echo "Variable intermedia interContenidoClaseDifuso: {$interContenidoClaseDifuso},
      Con un nivel de certeza de: {$interContNitido}<br/>";
      echo "Variable intermedia interCalidadClaseDifuso: {$interCalidadClaseDifuso},
      Con un nivel de certeza de: {$interCaliClaseNitido}<br/>";
    }
    $CalidadClaseNitido =
    $this->inferirCalificacionClaseCuantitativo($nivelAprendizajeDifuso,
    $interCalidadClaseDifuso);
    $CalificacionClaseNitidaFinal =
    $this->desfuzzificarProbabilidad($calificacionClaseDifuso, $CalidadClaseNitido);
    if($mostrarSalidas==true){
      echo "\n<br/>";
      echo "************************* Correspondencia nitida y difusa para
      variable de salida' *************************\n<br/>";
      echo "La calificación de la clase es de:
        {$CalificacionClaseNitidaFinal}<br/>";
        echo "Variable final calificacionClaseDifuso:
          {$calificacionClaseDifuso}, Con un nivel de certeza de:
            {$CalidadClaseNitido}<br/>";
            //Console.WriteLine("Con una certeza de: " + nivelMembresiaCondNatuInce);
          }

          //Establecer valores de las variables privadas en las variables publicas.
          $this->dificulSimuNitido = $dificulSimuNitido;
          $this->apoyoSimuNitido = $apoyoSimuNitido;
          $this->CalMatApoNitido = $CalMatApoNitido;
          $this->ClarMatApoNitido = $ClarMatApoNitido;
          $this->CantMatApoNitido = $CantMatApoNitido;
          $this->CalContNitido = $CalContNitido;
          $this->ClarContNitido = $ClarContNitido;
          $this->CantContNitido = $CantContNitido;
          $this->nivelAprendizajeNitido = $nivelAprendizajeNitido;
          $this->dificulSimuDifuso = $dificulSimuDifuso;
          $this->apoyoSimuDifuso = $apoyoSimuDifuso;
          $this->CalMatApoDifuso = $CalMatApoDifuso;
          $this->ClarMatApoDifuso = $ClarMatApoDifuso;
          $this->CantMatApoDifuso = $CantMatApoDifuso;
          $this->CalContDifuso = $CalContDifuso;
          $this->ClarContDifuso = $ClarContDifuso;
          $this->CantContDifuso = $CantContDifuso;
          $this->nivelAprendizajeDifuso = $nivelAprendizajeDifuso;
          $this->interSimuladorDifuso = $interSimuladorDifuso;
          $this->interMaterialApoyoDifuso = $interMaterialApoyoDifuso;
          $this->interContenidoClaseDifuso = $interContenidoClaseDifuso;
          $this->interCalidadClaseDifuso = $interCalidadClaseDifuso;
          $this->calificacionClaseDifuso = $calificacionClaseDifuso;
          $this->interSimuladorNitido = $interSimuladorNitido;
          $this->interMatApoNitido = $interMatApoNitido;
          $this->interContNitido = $interContNitido;
          $this->interCaliClaseNitido = $interCaliClaseNitido;
          $this->CalidadClaseNitido = $CalidadClaseNitido;
          $this->CalificacionClaseNitidaFinal = $CalificacionClaseNitidaFinal;
        }
      }
      ?>
