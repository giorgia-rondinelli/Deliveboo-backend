<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;



class Order extends Model
{
    use HasFactory;
    public function dishes(){
        return $this->belongsToMany(Dish::class);
    }
    protected $fillable=['slug','dish_id','total_prices','address','phone_number','name'];

    public function getFormattedCreatedAtAttribute()
    {
        // Converti la data in un oggetto DateTime
        $dateTime = new DateTime($this->created_at);

        // Imposta la localizzazione in italiano
        setlocale(LC_TIME, 'it_IT.UTF-8', 'it_IT', 'it', 'Italian_Italy.1252');

        // Format the date to a string in Italian senza il giorno della settimana
        $formattedDate = strftime('%d %B %Y', $dateTime->getTimestamp());

        // Assicurati che la prima lettera sia maiuscola
        $formattedDate = ucwords($formattedDate);

        return $formattedDate;
    }
}
