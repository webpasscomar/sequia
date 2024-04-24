<?php

namespace App\Jobs;

use App\Helpers\ShellCommand;
use App\Models\Capa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\TemporaryDirectory\TemporaryDirectory;

use ZipArchive;

class DescomprimirCapa implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Capa $capa)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $postgisHost = env('POSTGIS_HOST');
        $postgisPort = env('POSTGIS_PORT');
        $postgisDB = env('POSTGIS_DATABASE');
        $postgisUser = env('POSTGIS_USER');
        $postgisPassword = env('POSTGIS_PASSWORD');
        Log::debug($this->capa);
        # 1 - Descomprimir el archivo en una ruta temporal
        $capaFilename = $this->capa->capa_filename;
        if ($capaFilename) {
            # El directorio temporal se borra solo cuando termina el job.
            $temporaryDirectory = (new TemporaryDirectory())
                ->deleteWhenDestroyed()
                ->create();

            $tmpFile = $temporaryDirectory->path("capas/{$capaFilename}");

            $zip = new ZipArchive;
            $originalPath = Storage::disk('local')->path("indices/{$this->capa->indice->id}/{$capaFilename}");
            Log::debug($originalPath);
            Log::debug($tmpFile);
            if ($zip->open($originalPath) === TRUE) {
                $numFiles = $zip->numFiles;
                for ($i = 0; $i < $numFiles; $i++) {
                    $nombreArchivo = $zip->getNameIndex($i);
                    Log::debug($nombreArchivo);
                    # 2 - Por cada archivo válido de Rasters o Vectoriales guardarlos en capas.geom_capa o capas.raster
                    if (File::extension($nombreArchivo) == "shp") {
                        $zip->extractTo($tmpFile, $nombreArchivo);
                        $cmd = "ogr2ogr -f 'PostgreSQL' PG:'host={$postgisHost} port={$postgisPort} dbname={$postgisDB} user={$postgisUser} password={$postgisPassword}' {$tmpFile}/{$nombreArchivo}";
                        $cmdResult = ShellCommand::execute($cmd);
                    } elseif (File::extension($nombreArchivo) == "tiff") {
                        $zip->extractTo($tmpFile, $nombreArchivo);
                        $cmd = "raster2pgsql -a -I -C -s 4326 {$tmpFile}/{$nombreArchivo} public.rasters | PGPASSWORD={$postgisPassword} psql postgresql://{$postgisUser}@{$postgisHost}:{$postgisPort}/{$postgisDB}";
                        $cmdResult = ShellCommand::execute($cmd);
                    }
                }
                $zip->close();
                Log::debug('Archivos descomprimidos y nombres guardados correctamente.');
                //return response()->json(['message' => 'Archivos descomprimidos y nombres guardados correctamente.']);
            } else {
                Log::debug('Error al abrir el archivo ZIP.');
                //return response()->json(['error' => 'Error al abrir el archivo ZIP.']);
            }
        }
    }
}
