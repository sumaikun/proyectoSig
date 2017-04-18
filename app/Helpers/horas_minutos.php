<?php

namespace psig\Helpers;

class horas_minutos {   
  public static function calcular_tiempo_trasnc($hora1,$hora2){
        try {
            $separar[1]=explode(':',$hora1); 
            $separar[2]=explode(':',$hora2); 

            $total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1]; 
            $total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1]; 
            $total_minutos_trasncurridos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2]; 
            if($total_minutos_trasncurridos<=59) return($total_minutos_trasncurridos.' Minutos'); 
            elseif($total_minutos_trasncurridos>59)
            { 
                $HORA_TRANSCURRIDA = round($total_minutos_trasncurridos/60); 
                if($HORA_TRANSCURRIDA<=9) $HORA_TRANSCURRIDA='0'.$HORA_TRANSCURRIDA; 
                $MINUITOS_TRANSCURRIDOS = $total_minutos_trasncurridos%60; 
                if($MINUITOS_TRANSCURRIDOS<=9) $MINUITOS_TRANSCURRIDOS='0'.$MINUITOS_TRANSCURRIDOS; 
                return ($HORA_TRANSCURRIDA.':'.$MINUITOS_TRANSCURRIDOS.' Horas');
            }    
        }catch(\Exception  $e)
        {
            return 'N.A';
        } 
    
    }

   public static function taking_away_days($date2,$date1){
        $date1 = strtotime($date1);
        $date2 = strtotime($date2);
        $datediff = $date2 - $date1;
        return floor($datediff / (60 * 60 * 24));
   } 
}    