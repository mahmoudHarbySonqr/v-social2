<?php

namespace App\Traits;

use Storage  ;
use Config   ;
use Route    ;
use Str      ;
use URL      ;
use File     ;
use Response ;

use Illuminate\Http\Response as retrunResponse ;
use Illuminate\Filesystem\FilesystemAdapter ;
use Illuminate\Http\UploadedFile ;

trait StorageTraits{

    /**
     * initialize the Translate Json Fields trait for a model.
     *
     * @return void
     */
    public function initializeStorageTraits( ) : void {
        Config::set( 'filesystems.disks.' . $this -> GetPathRoute( ) , [
            'visibility' => 'public' ,
            'driver'     => 'local'  ,
            'root'       => storage_path( 'app/public/' . $this -> GetPathRoute( ) )  ,
        ] );
    }

    /**
     * Get Path Route
     *
     * @return string
     */
    public function GetPathRoute( ) : string {
        return class_basename( get_class( $this ) ) ;
    }

    /**
     * Get Storage
     *
     * @return FilesystemAdapter
     */
    public function Storage( ) : FilesystemAdapter {
        return Storage::disk( $this -> GetPathRoute( ) ) ;
    }

    public function getUrlColumnNameAttributeStorageTraits( ) :? string {
        return $this -> hash ;
    }

    public function geturlAttribute( ) :? string {
        return ( $ColumnName = str_replace( '/' , '|' , $this -> getUrlColumnNameAttributeStorageTraits( ) ) ) ? URL::route( 'Web.Storage.' . $this -> GetPathRoute( ) , [ 'Hash' => $ColumnName ] ) : null ;
    }

    public static function GetByHash( string $Hash ) : retrunResponse {
        return ( $Route = new static ) -> Storage( ) -> exists( $Hash ) ? Response::make( $Route -> Storage( ) -> get( $Hash ) , 200 ) -> header( 'Content-Type' , $Route -> Storage( ) -> mimeType( $Hash ) ) : abort( 404 ) ;
    }

    public function getHashPath( UploadedFile $File ) : string {
        return $this -> Storage( ) -> putFile( $File -> getMimeType( ) , $File ) ;
    }

    public function saveInDataBase( UploadedFile $Avatar ) : string {
        $this -> hash = $this -> getHashPath( $Avatar ) ;
        $this -> save( ) ;
        return $this -> refresh( ) ;
    }

}