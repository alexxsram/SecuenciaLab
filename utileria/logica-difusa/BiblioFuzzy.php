<?php
class BiblioFuzzy
{
  /**************************************************************************************************
  *************************************** Método constructor ****************************************
  **************************************************************************************************/
  /**************************************************************************************************
  ************************************ Funciones de Membresía **************************************
  **************************************************************************************************/

  /*Función Γ (Gamma, Trapecio Abierto Derecha)
  * Γ: U→[0, 1], Γ(u; α, β)
  * Γ(u; α, β) = { 0 si u<α, (u−α)/(β−α) si α≤u≤β, 1 si u>β }*/
  public static function TrapecioAbiertoDerecho($u, $a, $b)
  {
    $resultado = -1.0;
    if ($u > $b)
    {
      $resultado = 1.0;
    }
    else if ($u < $a)
    {
      $resultado = 0.0;
    }
    else if ($a <= $u && $u <= $b)
    {
      $resultado = ($u - $a) / ($b - $a);
    }
    return $resultado;
  }

  /*Función L (Trapecio Abierto Izquierda)
  * L: U→[0, 1], L(u; α, β)
  * L(u; α, β) = { 1 si u<α, (β−u)/(β−α) α≤u≤β, 0 si u>β }*/
  public static function TrapecioAbiertoIzquierdo($u, $a, $b)
  {
    $resultado = -1.0;
    if ($u > $b)
    {
      $resultado = 0.0;
    }
    else if ($u < $a)
    {
      $resultado = 1.0;
    }
    else if (a <= u && u <= b)
    {
      $resultado = ($b - $u) / ($b - $a);
    }
    return $resultado;
  }

  /*Función Λ (Lambda, Triangular)
  * Λ: U→[0, 1], Λ(α, β, γ)
  * Λ(α, β, γ) = { 0 si u < α, (u−α)/(β−α) si α ≤ u ≤ β,
  * (γ-u)/(γ-β) si β ≤ u ≤ γ, 0 si u > γ }*/
  public static function Triangular($u, $a, $b, $c)
  {
    $resultado = -1.0;
    if ($u < $a || $u > $c)
    {
      $resultado = 0.0;
    }
    else if ($a <= $u && $u < $b)
    {
      $resultado = ($u - $a) / ($b - $a);
    }
    else if ($b <= $u && $u <= $c)
    {
      $resultado = ($c - $u) / ($c - $b);
    }
    return $resultado;
  }

  /*Función Π (Pi, Trapecio)
  * Π: U→[0, 1], Π(α, β, γ, δ)
  * Π(α, β, γ, δ) = { 0 si u < α, (u−α)/(β−α) si α≤u<β, 1 si β≤u≤γ
  * (δ−u)/(δ−γ) si γ<u≤δ, 0 si u > δ }*/
  public static function Trapezoidal($u, $a, $b, $c, $d)
  {
    $resultado = -1.0;
    if ($u < $a || $u > $d)
    {
      $resultado = 0.0;
    }
    else if ($b <= $u && $u <= $c)
    {
      $resultado = 1.0;
    }
    else if ($a <= $u && $u < $b)
    {
      $resultado = ($u - $a) / ($b - $a);
    }
    else if ($c < $u && $u <= $d)
    {
      $resultado = ($d - $u) / ($d - $c);
    }
    return $resultado;
  }

  /*Función S
  * S: U→[0, 1], S(u; α, β)
  * S(u; α, β) = { 0 si u<α, 0.5*(1+cos(((u-β)/(β-α))*π)) si α≤u≤β, 1 si u>β }*/
  public static function Curva_S($u, $a, $b)
  {
    $resultado = -1.0;
    if ($u > $b)
    {
      $resultado = 1.0;
    }
    else if ($u < $a)
    {
      $resultado = 0.0;
    }
    else if ($a <= $u && $u <= $b)
    {
      $resultado = (1 + cos((($u - $b) / ($b - $a)) * M_PI)) / 2.0;
    }
    return $resultado;
  }

  /*Función Z
  * Z: U→[0, 1], Z(u; α, β)
  * Z(u; α, β) = { 1 si u<α, 0.5*(1+cos(((u-α)/(β-α))*π)) si α≤u≤β, 0 si u>β }*/
  public static function Curva_Z($u, $a, $b)
  {
    $resultado = -1.0;
    if ($u > $b)
    {
      $resultado = 0.0;
    }
    else if ($u < $a)
    {
      $resultado = 1.0;
    }
    else if ($a <= $u && $u <= $b)
    {
      $resultado = (1 + cos((($u - $a) / ($b - $a)) * M_PI)) / 2.0;
    }
    return $resultado;
  }

  /*Función SΛ (Soft Lambda, Triangular Suave)
  * SΛ: U→[0, 1], SΛ(α, β, γ)
  * SΛ(α, β, γ) = { 0 si u < α, 0.5*(1+cos(((u-β)/(β-α))*π)) si α ≤ u ≤ β,
  * 0.5*(1+cos(((u-β)/(γ-β))*π)) si β ≤ u ≤ γ, 0 si u > γ }*/
  public static function TriangularSuave($u, $a, $b, $c)
  {
    $resultado = -1.0;
    if ($u < $a || $u > $c)
    {
      $resultado = 0.0;
    }
    else if ($a <= $u && $u < $b)
    {
      $resultado = (1 + cos((($u - $b) / ($b - $a)) * M_PI)) / 2.0;
    }
    else if ($b <= $u && $u <= $c)
    {
      $resultado = (1 + cos((($b - $u) / ($c - $b)) * M_PI)) / 2.0;
    }
    return $resultado;
  }

  /*Función SΠ (Soft Pi, Trapecio Suave)
  * SΠ: U→[0, 1], SΠ(α, β, γ, δ)
  * SΠ(α, β, γ, δ) = { 0 si u < α, 0.5*(1+cos(((u-β)/(β-α))*π)) si α ≤ u ≤ β,
  * 1 si β ≤ u ≤ γ, 0.5*(1+cos(((u-γ)/(δ-γ))*π)) si γ ≤ u ≤ δ,
  * 0 si u > δ }*/
  public static function TrapezoidalSuave($u, $a, $b, $c, $d)
  {
    $resultado = -1.0;
    if ($u < $a || $u > $d)
    {
      $resultado = 0.0;
    }
    else if ($b <= $u && $u <= $c)
    {
      $resultado = 1.0;
    }
    else if ($a <= $u && $u < $b)
    {
      $resultado = (1 + cos((($u - $b) / ($b - $a)) * M_PI)) / 2.0;
    }
    else if ($c < $u && $u <= $d)
    {
      $resultado = (1 + cos((($c - $u) / ($d - $c)) * M_PI)) / 2.0;
    }
    return $resultado;
  }

  /**************************************************************************************************
  ************************************** Accesorios de apoyo ***************************************
  **************************************************************************************************/

  public static function Minimo($a, $b)
  {
    $resultado = -1.0;
    if ($a < $b)
    {
      $resultado = $a;
    }
    else
    {
      $resultado = $b;
    }
    return $resultado;
  }

  public static function Maximo($a, $b)
  {
    $resultado = -1.0;
    if ($a > $b)
    {
      $resultado = $a;
    }
    else
    {
      $resultado = $b;
    }
    return $resultado;
  }

  /**************************************************************************************************
  *********************************** Operadores lógicos Fuzzy *************************************
  **************************************************************************************************/

  public static function ComparacionAND($ma_u, $mb_u)
  {
    return Minimo($ma_u, $mb_u);
  }

  public static function ComparacionOR($ma_u, $mb_u)
  {
    return Maximo($ma_u, $mb_u);
  }

  public static function Niega($ma_u)
  {
    return 1.0 - $ma_u;
  }

  /**************************************************************************************************
  *************************************** Implicación Fuzzy ****************************************
  **************************************************************************************************/

  public static function ImplicaZadeh($ma_x, $mb_y)
  {
    return Maximo(Minimo($ma_x, $mb_y), Niega($ma_x));
  }

  public static function ImplicaMamdani($ma_x, $mb_y)
  {
    return Minimo($ma_x, $mb_y);
  }

  public static function ImplicaGodel($ma_x, $mb_y)
  {
    $resultado = -1.0;
    if ($ma_x <= $mb_y)
    {
      $resultado = 1.0;
    }
    else
    {
      $resultado = $mb_y;
    }
    return $resultado;
  }
}

/*$vegetariano = new BiblioFuzzy();
echo $vegetariano->Triangular(4, 0, 5, 10);
echo BiblioFuzzy::Triangular(4, 0, 5, 10);*/
?>
