<?php

/**
* Agregamos los locales y sucursales por defecto
*/
class LocalTableSeeder extends Seeder{
    public function run(){
        //Creacion de los locales/tiendas
        $falabella = Tienda::create(array(
            'nombre' => "Falabella",
            'estado' => 1
        ));

        $hites = Tienda::create(array(
            'nombre' => "Hites",
            'estado' => 1
        ));

        $lapolar = Tienda::create(array(
            'nombre' => "La Polar",
            'estado' => 1
        ));

        $paris = Tienda::create(array(
            'nombre' => "Paris",
            'estado' => 1
        ));

        $ripley = Tienda::create(array(
            'nombre' => "Ripley",
            'estado' => 1
        ));

        //Creacion de las sucursales
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(RM) PARQUE ARAUCO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(RM) PLAZA OESTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(RM) PLAZA VESPUCIO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(VIII) CHILLAN', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(II) MALL ANTOFAGASTA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(IV) LA SERENA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(VIII) CONCEPCION EL TREBOL', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(RM) PLAZA NORTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(RM) PLAZA PUENTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(VII) TALCA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(RM) PLAZA TOBALABA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(X) PUERTO MONTT', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(RM) CENTRO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(X) OSORNO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => 'ARAUCO MAIPU', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(RM) LYON', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => 'PLAZA EGAÑA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(III) COPIAPO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(V) VALPARAISO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => 'ESTACION CENTRAL', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(VI) RANCAGUA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(VIII) LOS ANGELES', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(RM) SAN BERNARDO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(VII) CURICO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(VIII) CONCEPCION CENTRO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(X) VALDIVIA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(V) LA CALERA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(V) QUILPUE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(V) VIÑA DEL MAR', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $falabella->id,
            'nombre' => '(RM) PLAZA VESPUCIO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'OVALLE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'SAN BERNARDO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'RANCAGUA_756', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'TEMUCO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'TIENDA COPIAPO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'ESTACION CENTRAL', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'LA SERENA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'ANTOFAGASTA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'CONCEPCION', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'PLAZA ARMAS', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'PUENTE ALTO 175', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'PUENTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $lapolar->id,
            'nombre' => 'PUENTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $lapolar->id,
            'nombre' => 'OVALLE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $lapolar->id,
            'nombre' => 'FLOTANTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $lapolar->id,
            'nombre' => 'FLOTANTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'PORTAL TEMUCO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'BARROS ARANA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $hites->id,
            'nombre' => 'SAN BERNARDO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'PLAZA OESTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'PLAZA OESTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'MARINA ARAUCO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'PARQUE ARAUCO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'PLAZA LA SERENA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'COSTANERA CENTER', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'PLAZA VESPUCIO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'TEMUCO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'SAN BERNARDO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'LOS ANGELES', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'MALL PASEO ESTACIÒN', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'ANTOFAGASTA II', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'TALCA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'FLORIDA CENTER', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'PUERTO MONTT', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'ALAMEDA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'EL ROBLE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'ALTO LAS CONDES', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'PLAZA DEL TRÉBOL', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'LYON', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'RANCAGUA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $paris->id,
            'nombre' => 'CALAMA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'MARINA ARAUCO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'PUENTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'PLAZA VESPUCIO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'PLAZA OESTE', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'El Trebol', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'FLORIDA CENTER', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'TALCA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'RANCAGUA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'PARQUE ARAUCO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'COSTANERA CENTER', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'SAN BERNARDO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'ALTO LAS CONDES', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'ANTOFAGASTA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'HUECHURABA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'NUEVA ALAMEDA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'CRILLON', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'VALPARAISO', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'PLAZA EGAÑA', 
            'direccion' => '', 
            'estado' => 1
        ));
        SucursalPlace::create(array(
            'local_id' => $ripley->id,
            'nombre' => 'Mall Concepcion', 
            'direccion' => '',
            'estado' => 1
        ));
    }
}