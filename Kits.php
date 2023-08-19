<?php


class Kits {

    private $chip = FALSE;
    private $numero = FALSE;
    private $remera= FALSE;
    private $medalla = FALSE;

    public function mostrar(){
        echo("El kit incluye: ");
        if ($this->chip) {echo ("chip ");}
        if ($this->numero) {echo ("número ");}
        if ($this->remera) {echo ("remera ");}
        if ($this->medalla) {echo ("medalla.");}
    }

    public function toArray(){
        $arreglo = array( 
            "chip" => $this->chip,
            "numero" => $this->numero,
            "remera" => $this->remera,
            "medalla" => $this->medalla);
        return $arreglo;
       }

    /**
     * Get the value of chip
     */ 
    public function getChip()
    {
        return $this->chip;
    }

    

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Get the value of remera
     */ 
    public function getRemera()
    {
        return $this->remera;
    }

    /**
     * Get the value of medalla
     */ 
    public function getMedalla()
    {
        return $this->medalla;
    }

     /**
     * Set the value of chip
     *
     * @return  self
     */ 
    public function setChip($chip)
    {
        $this->chip = $chip;

        return $this;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Set the value of remera
     *
     * @return  self
     */ 
    public function setRemera($remera)
    {
        $this->remera = $remera;

        return $this;
    }

    /**
     * Set the value of medalla
     *
     * @return  self
     */ 
    public function setMedalla($medalla)
    {
        $this->medalla = $medalla;

        return $this;
    }
}