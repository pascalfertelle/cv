<?php
class Pret
{
  private $_K;
  private $_mensualite;
  private $_assurance;
  private $_duree;
  private $_FraisDeDossier;
  private $_TAEG;
  private $_ImpactFraisDeDossier;
  private $_ImpacteAssurance;
  private $_taux1;

  const N=1;


  public function __construct($K, $mensualite, $assurance,$duree,$FraisDeDossier) // Constructeur demandant 5 paramètres
  {
    $this->setK($K);// Initialisation du capital K.
    $this->setMensualite($mensualite); // Initialisation de la mensualité.
    $this->setAssurance($assurance); // Initialisation de l'assurance.
    $this->setDuree($duree); // Initialisation de la durée.
    $this->setFraisDedossier($FraisDeDossier);//Initialisation des frais de dossier.
    $this->setTaux();//Initialisation de TAEG, ImpactFraisDeDossier, ImpactAssurance.
  }

  // Mutateur chargé de modifier l'attribut $_K.
  public function setK($K)
  {
    if (!is_int($K)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('La montant d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($K < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('La montant d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }
    
    $this->_K = $K;
  }

  // Mutateur chargé de modifier l'attribut $_mensualite.
  public function setMensualite($mensualite)
  {
    if (!is_int($mensualite)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('La mensualité d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($mensualite < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('La mensualité d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }

    $this->_mensualite = $mensualite;
  }

 // Mutateur chargé de modifier l'attribut $_assurance.
  public function setAssurance($assurance)
  {
    if (!is_int($assurance)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('L\'assurance d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($assurance < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('L\'assurance d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }

    $this->_assurance = $assurance;
  }

   // Mutateur chargé de modifier l'attribut $_duree.
  public function setDuree($duree)
  {
    if (!is_int($duree)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('La durée d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }

if ($duree < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('La durée d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }
    $duree=$duree;
    $this->_duree = 12*$duree;

  }

   // Mutateur chargé de modifier l'attribut $_FraisDeDossier.
  public function setFraisDedossier($FraisDeDossier)
  {
    if (!is_int($FraisDeDossier)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('Les frais de dossier d\'un prêt doit être un nombre entier', E_USER_WARNING);
      return;
    }


    if ($FraisDeDossier < 0) // On vérifie bien qu'on ne souhaite pas assigner une valeur négative.
    {
      trigger_error('Ls frais de dossier d\'un prêt ne peut être négative', E_USER_WARNING);
      return;
    }

    $this->_FraisDeDossier = $FraisDeDossier;
  }

// Liste des getters

  public function K()
  {
    return $this->_K;
  }

   public function mensualite()
  {
    return $this->_mensualite;
  }

 public function assurance()
  {
    return $this->_assurance;
  }

 public function duree()
  {
    return $this->_duree;
  }

 public function FraisDeDossier()
  {
    return $this->_FraisDeDossier;
  }

  
  public function TAEG()
  {
    return $this->_TAEG;
  }

  public function ImpactFraisDeDossier()
  {
    return $this->_ImpactFraisDeDossier;
  }
  

  public function ImpactAssurance()
  {
    return $this->_ImpactAssurance;
  }




  public function setTaux()
  {
  	$calcul=10;
  	$n=self::N;
  	$taux=0.005;
  	$K=$this->_K;
  	$m=$this->_mensualite;
  	$durée=$this->_duree;
  	$a=$this->_assurance;
  	$fd=$this->_FraisDeDossier;
    while ($calcul > 0.00001) 
        {
          $calcul=0;
          $taux = $taux - 0.0000001;
          while ($n<=$durée)
          {
            $calcul=$calcul + ($m/(1+$taux)**$n);
            $n=$n+1;
          }
          $calcul=$K-$calcul;
          $n=1;
        }
      while ($calcul<-0.00001) 
        {
          $calcul=0;
          $taux = $taux + 0.00000001;
          while ($n<=$durée)
          {
            $calcul=$calcul + (($m)/(1+$taux)**$n);
            $n=$n+1;
          }
          $calcul=$K-$calcul;
          $n=1;
        }
      
      $taux1=$taux;
      $this->_taux1

      $calcul=-1;

      while ($calcul<-0.00001) 
        {
          $calcul=0;
          $taux = $taux + 0.00000001;
          while ($n<=$durée)
          {
            $calcul=$calcul + (($m)/(1+$taux)**$n);
            $n=$n+1;
          }
          $calcul=$K-$fd-$calcul;
          $n=1;
        }

      $taux2=$taux;

      $calcul=-1;

      while ($calcul<-0.00001) 
        {
          $calcul=0;
          $taux = $taux + 0.00000001;
          while ($n<=$durée)
          {
            $calcul=$calcul + (($m+$a)/(1+$taux)**$n);
            $n=$n+1;
          }
          $calcul=$K-$fd-$calcul;
          $n=1;
        }

      $taux3=$taux;
      $this->_TAEG = round((((1+$taux3)**12-1)*100),2);
      $this->_ImpactFraisDeDossier = round(((((1+$taux2)**12-1)-((1+$taux1)**12-1))*100),2);
      $this->_ImpactAssurance = round(((((1+$taux3)**12-1)-((1+$taux2)**12-1))*100),2);
  }

  public function ArrayAmortissement()
  {
  	$n=self::N;
  while ($n<=$durée) 
	{

	$intêrets=$K*$taux1;
	$intêrets=round($intêrets,2);
	$Kremboursé=$m-$intêrets;
	$K=$K-$Kremboursé;
  }
}
$pret1= new Pret(100000,900,30,10,500);
echo 'le TAEG est de '.$pret1->TAEG().'%<br>';
echo 'les frais de dossier ont un impact de '.$pret1->ImpactFraisDeDossier().'% sur le TAEG<br>';
echo 'l\'assurance du prêt a un impact de '.$pret1->ImpactAssurance().'% sur le TAEG';
?>