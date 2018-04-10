<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'name'
    ];

    static function fixStuff()
    {
        self::createFromSensorData();
        self::assignReadingsToSensor();
    }

    static function createFromSensorData()
    {
        $reporters = Reading::select('reporter')->groupBy('reporter')->get();
        foreach($reporters as $reporter) {
            if (empty($reporter->reporter)) {
                $reporter->reporter = 'empty';
            }
            if (self::where('name','=',$reporter->reporter)->count() == 0) {
                $newSensor = self::create(['name' => $reporter->reporter]);
                $newSensor->save();
            }
        }
    }

    static function assignReadingsToSensor()
    {
        $sensors = self::all();
        foreach($sensors as $sensor) {
            if ($sensor->name == 'empty') {
                Reading::whereNull('reporter')->update(['sensor_id'=> $sensor->id]);
            } else {
                Reading::where('reporter','=',$sensor->name)->update(['sensor_id'=> $sensor->id]);
            }
        }
    }

    public function readings()
    {
        return $this->hasMany('App\Reading','sensor_id','id');
    }
}