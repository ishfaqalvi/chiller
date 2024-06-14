<?php


use App\Models\Brand;
use App\Models\Chiller;
use App\Models\Setting;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function uploadFile($file, $path, $width, $height)
{
    $extension = $file->getClientOriginalExtension();
    $name = uniqid().".".$extension;

    $folder = 'upload/images/'.$path;
    $finalPath = $folder.'/'.$name;
    $file->move($folder, $name);

    Image::load($finalPath)->fit(Manipulations::FIT_CROP, $width, $height)->save(public_path($finalPath));
    return $finalPath;
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function settings($key)
{
    return Setting::get($key);
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function chillers()
{
    return Chiller::get();
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function chiller($id)
{
    return Chiller::find($id);
}

/**
 * Get listing of a resource.
 *
 * @return \Illuminate\Http\Response
 */
function brands()
{
    return Brand::pluck('name','id');
}


function powerSet($in)
{
    $count = count($in);
    $members = pow(2, $count);
    $return = [];

    for ($i = 0; $i < $members; $i++) {
        $b = sprintf("%0" . $count . "b", $i);
        $out = [];
        for ($j = 0; $j < $count; $j++) {
            if ($b[$j] == '1') $out[] = $in[$j];
        }
        $return[] = $out;
    }

    return $return;
}
