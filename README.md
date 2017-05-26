{
    "require": {
        "kunalvarma05/dropbox-php-sdk": "^0.2.0"
    }
}


utilDropBox v1
================
Este Clase me hace la vida mas facil al acceder a los recursos de DropBox.
Hago uso de la clase provista por SDK de DropBox. 
Dropbox SDK v2 for PHP (https://github.com/kunalvarma05/dropbox-php-sdk)


Installation
------------
The preferred way to install this library is to rely on Composer:

composer requiere rauljrz/utildropbox


Get Started
-----------

require "vendor/autoload.php";
$oo = new utilDBx();

$aResult = $oo->upload('c:\mis documentos\archivoholamundo.doc', '/archivoholamundo.doc');

if ($aResult['status']=='SUCCESS') {
	echo 'upload OK';
} else {
	echo 'upload ERROR: '.$aResult['message'];
}


En el ejemplo se supone que se hace uso de composer 


## Docu
    /**
	 * searchFile($cFileName, $cPath )
     * ==============================
     * 
     * Realiza la busqueda de un archivo a partir del path que se le indica. Si no path, lo hace desde raiz
     * @param     string                   $cFileName Es el nombre del archivo a buscar
     * @param     string                   $cPath     Es la ruta en donde se buscara el archivo, si no se lo pasa, toma la raiz
     * @return    array                               Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */

    /**
     * delete($cFileName)
     * ==================
     * 
     * Metodo para Eliminar un archivo o carpeta
     * @param     varchar         $cFileName Nombre con el Path del archivo a borrar
     * @return    array                      Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */
    
     /**
     * copy($cFileOrigen, $cFileDestino)
     * =================================
     * 
     * Metodo para Copiar archivos dentro del DropBox
     * Metodo para Copiar archivos dentro del DropBox
     * @param     varchar         $cFileOrigen  Path+Nombre del Archivo a Copiar
     * @param     varchar         $cFileDestino Path+Nombre del Archivo resultante
     * @return    array                         Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */
    
     /**
     * move($cFileOrigen, $cFileDestino)
     * ================================
     * 
     * Metodo para Mover archivos dentro de DropBox
     * @param     varchar         $cFileOrigen  Path+Nombre del Archivo a ser Movido
     * @param     varchar         $cFileDestino Path+Nombre del Archivo resultante
     * @return    array                         Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */
    

     /**
     * download($cFileOrigen, $cFileDestino)
     * =====================================
     * 
     * Metodo para realizar Descargar de Archivos de DropBox
     * @param     varchar         $cFileOrigen  Path+Nombre del Archivo en DropBox
     * @param     varchar         $cFileDestino Path+Nombre del Archivo en carpeta Local
     * @return    array                         Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */
    
     /**
     * upload($cFileOrigen, $cFileDestino)
     * ==================================
     * 
     * Metodo para realizar la Subida de Archivos a DropBox
     * @param     varchar         $cFileOrigen  Path+Nombre del Archivo en la pc Local
     * @param     varchar         $cFileDestino Path+Nombre del Archivo en DropBox
     * @return    array                         Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */

## License
/*
 * ----------------------------------------------------------------------------
 * "THE BEER-WARE LICENSE" (Revision 42):
 * <phk@FreeBSD.ORG> wrote this file. As long as you retain this notice you
 * can do whatever you want with this stuff. If we meet some day, and you think
 * this stuff is worth it, you can buy me a beer in return Poul-Henning Kamp
 * ----------------------------------------------------------------------------
 */

