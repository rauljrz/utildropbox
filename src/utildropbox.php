<?php

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;

/**
 * Clase para gestionar los archivos en DropBox, usando la clase provista por Dropbox
 *         # Dropbox SDK v2 for PHP (https://github.com/kunalvarma05/dropbox-php-sdk)
 *
 */
class utilDropBox
{
    private $client_id;
    private $client_secret;
    private $access_token;
    private $app;
    private $dropbox;

    /**
     * Metodo magico Constructor de la Clase. Inicia a la clase y carga parametros
     * @author @rauljrz - http://rauljrz.github.io
     * @date-time 2017-05-25T18:48:39-0300
     */
    public function __construct()
    {
        // ClienteKey - ESTOS SON DEL YB
        $this->client_id     = "la debes generar en dropbox develop";
        $this->client_secret = "la debes generar en dropbox develop";
        $this->access_token  = "la debes generar en dropbox develop";

        $this->app = new DropboxApp($this->client_id, $this->client_secret, $this->access_token);

        //Configure Dropbox service
        $this->dropbox = new Dropbox($this->app);
    }

    /**
     * searchFile($cFileName, $cPath )
     * ==============================
     * 
     * Realiza la busqueda de un archivo a partir del path que se le indica. Si no path, lo hace desde raiz
     * @author @rauljrz - http://rauljrz.github.io
     * @date-time 2017-05-24T00:19:26-0300
     * @param     string                   $cFileName Es el nombre del archivo a buscar
     * @param     string                   $cPath     Es la ruta en donde se buscara el archivo, si no se lo pasa, toma la raiz
     * @return    array                               Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */
    public function searchFile($cFileName, $cPath = '/')
    {
        $aReturn = array();

        if (isset($cFileName) && !empty($cFileName)) {
            $cFileName = trim($cFileName);
        } else {
            return array('status'  => 'ERROR',
                         'message' => 'Debe pasar como parametro el archivo y la carpeta en donde buscar',
                         'data'    => '');
        }

        if (isset($cPath) && empty($cPath)) {
            $cPath = '/';
        }

        $dropbox       = $this->dropbox;
        $searchResults = $dropbox->search($cPath, $cFileName, ['start' => 0, 'max_results' => 5]);

        //Fetch Items (Returns an instance of ModelCollection)
        $items = $searchResults->getItems();

        //All Items
        $items->all();

        //First Item (Returns an instance of SearchResult)
        $item = $items->first();

        if (isset($item) && !empty($item) && !is_null($item)) {
            //Get the type of match, that was found for the result
            $matchtype = $item->getMatchType();

            //Get the Metadata of the File or Folder
            $metadata = $item->getMetadata();

            $aReturn = array('status' => 'SUCCESS', 'message' => 'Se encontro el archivo', 'data' => $metadata);
        } else {
            $aReturn = array('status' => 'ERROR', 'message' => '¡NO se encontro!!', 'data' => '');
        }
        return $aReturn;
    }

    /**
     * delete($cFileName)
     * ==================
     * 
     * Metodo para Eliminar un archivo o carpeta
     * @author @rauljrz - http://rauljrz.github.io
     * @date-time 2017-05-25T18:51:48-0300
     * @param     varchar         $cFileName Nombre con el Path del archivo a borrar
     * @return    array                      Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */
    public function delete($cFileName)
    {
        $aReturn = array();

        $dropbox       = $this->dropbox;
        $deletedFolder = $dropbox->delete($cFileName);

        //Name
        $deletedFolder->getName();

        return array('status' => 'SUCCESS', 'message' => 'Se borro el archivo: ' . $cFileName, 'data' => '');
    }

    /**
     * copy($cFileOrigen, $cFileDestino)
     * =================================
     * 
     * Metodo para Copiar archivos dentro del DropBox
     * @author @rauljrz - http://rauljrz.github.io
     * @date-time 2017-05-25T18:53:04-0300
     * @param     varchar         $cFileOrigen  Path+Nombre del Archivo a Copiar
     * @param     varchar         $cFileDestino Path+Nombre del Archivo resultante
     * @return    array                         Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */
    public function copy($cFileOrigen, $cFileDestino)
    {
        $aReturn = array();

        $dropbox = $this->dropbox;
        $file    = $dropbox->copy($cFileOrigen, $cFileDestino);

        //Name
        $file->getName();
        return array('status' => 'SUCCESS',
                     'message'=> 'Se borro el archivo: ' . $cFileOrigen, 'data' => '');
    }

    /**
     * move($cFileOrigen, $cFileDestino)
     * ================================
     * 
     * Metodo para Mover archivos dentro de DropBox
     * @author @rauljrz - http://rauljrz.github.io
     * @date-time 2017-05-25T19:37:42-0300
     * @param     varchar         $cFileOrigen  Path+Nombre del Archivo a ser Movido
     * @param     varchar         $cFileDestino Path+Nombre del Archivo resultante
     * @return    array                         Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */
    public function move($cFileOrigen, $cFileDestino)
    {
        $aReturn = array();

        // Download and the save the file at the given path
        $dropbox = $this->dropbox;
        $file    = $dropbox->move($cFileOrigen, $cFileDestino);

        //Name
        $file->getName();

        if (!empty($cFileName) && !is_null($cFileName)) {
            $aReturn = array('status' => 'SUCCESS',
                             'message'=> 'Se Movio con exito ' . $cFileOrigen, 'data' => '');
        } else {
            $aReturn = array('status' => 'ERROR',
                             'message'=> 'No se Movio el archivo',
                             'data'   => '');
        }
        return $aReturn;
    }

    /**
     * download($cFileOrigen, $cFileDestino)
     * =====================================
     * 
     * Metodo para realizar Descargar de Archivos de DropBox
     * @author @rauljrz - http://rauljrz.github.io
     * @date-time 2017-05-25T19:39:36-0300
     * @param     varchar         $cFileOrigen  Path+Nombre del Archivo en DropBox
     * @param     varchar         $cFileDestino Path+Nombre del Archivo en carpeta Local
     * @return    array                         Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */
    public function download($cFileOrigen, $cFileDestino)
    {
        $aReturn = array();

        // Download and the save the file at the given path
        $dropbox = $this->dropbox;
        $file    = $dropbox->download($cFileDestino, $cFileOrigen);

        //Downloaded File Metadata
        $metadata = $file->getMetadata();

        //Name
        $cFileName = $metadata->getName();

        if (!empty($cFileName)) {
            $aReturn = array('status' => 'SUCCESS',
                             'message'=> 'Se Descargo con exito ' . $cFileOrigen, 'data' => '');
        } else {
            $aReturn = array('status' => 'ERROR',
                             'message'=> 'No se puede descargar',
                             'data'   => '');
        }
        return $aReturn;
    }

    /**
     * upload($cFileOrigen, $cFileDestino)
     * ==================================
     * 
     * Metodo para realizar la Subida de Archivos a DropBox
     * @author @rauljrz - http://rauljrz.github.io
     * @date-time 2017-05-25T19:59:27-0300
     * @param     varchar         $cFileOrigen  Path+Nombre del Archivo en la pc Local
     * @param     varchar         $cFileDestino Path+Nombre del Archivo en DropBox
     * @return    array                         Array con los datos de los archivos encontrado.
     *            El array resultante tiene la siguiente forma:
     *                status:     Posibles valores: SUCCESS o ERROR
     *                message:    Mensaje devuelto por la clase hasta 50 caracteres
     *                data:       Valor extra/anexos.
     */
    public function upload($cFileOrigen, $cFileDestino)
    {
        $aReturn = array();
        $dropbox = $this->dropbox;

        $dropboxFile = new DropboxFile($cFileOrigen);
        $file        = $dropbox->upload($dropboxFile, $cFileDestino, ['autorename' => true]);

        //Uploaded File
        $cFileName = $file->getName();

        if (!empty($cFileName) && !is_null($cFileName)) {
            $aReturn = array('status'  => 'SUCCESS',
                			 'message' => 'Se Subio con exito ' . $cFileOrigen, 'data' => '');
        } else {
            $aReturn = array('status'  => 'ERROR',
                			 'message' => 'No se subio el archivo',
                			 'data'    => '');
        }
        return $aReturn;
    }
}
