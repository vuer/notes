# Notes (Laravel 5 Package)

[![Latest Stable Version](https://poser.pugx.org/vuer/notes/v/stable)](https://packagist.org/packages/vuer/notes) [![Total Downloads](https://poser.pugx.org/vuer/notes/downloads)](https://packagist.org/packages/vuer/notes) [![Latest Unstable Version](https://poser.pugx.org/vuer/notes/v/unstable)](https://packagist.org/packages/vuer/notes) [![License](https://poser.pugx.org/vuer/notes/license)](https://packagist.org/packages/vuer/notes)

## Installation

You can install this package via composer using this command:
  
```
composer require vuer/notes
```

Next, you must install the service provider:

``` php
// config/app.php
'providers' => [
    ...
    Vuer\Notes\NotesServiceProvider::class,
];
```

Publish migration and configuration file:

```
php artisan vendor:publish
```

After the migration has been published you can create the notes table by running the migrations:
```
php artisan migrate
```

If you want you can change models in notes config file (config/notes.php):
```
  /*
   * The class name of the note model to be used.
   */
  'note_model' => \Vuer\Notes\Models\Note::class,

  /*
   * The class name of the author model to be used.
   */
  'author_model' => \App\User::class,
```

## Usage
### Preparing your model

To associate notes with a model, the model must implement the following trait:
``` php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Vuer\Notes\Traits\HasNotes;

class User extends Model
{
    use HasNotes;
    ...
}
```

### Creating notes
You can create a note for the model like this:
``` php
$user = User::find(1);
$note = $user->createNote(['body' => 'Lorem ipsum...']);
```
To save note author you should add second parameter:
``` php
$note = $user->createNote(['body' => 'Lorem ipsum...'], \Auth::user());
```
If you want to save author name you need to create **getNotesAuthorName** method in author class. It is useful if you want to delete users and keep informations about notes authors.
``` php
<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Vuer\Notes\Traits\HasNotes;

class User extends Authenticatable
{
    use HasNotes;

    public function getNotesAuthorName()
    {
        return trim(sprintf('%s %s', $this->name, $this->surname));
    }
}
```
You can get all notes or 1 note:
``` php
$notes = $user->notes;
$note = $user->note;
```
You can use it to create model description:
``` php
  protected $fillable = [
    'description',
  ];

  public function setDescriptionAttribute($value)
  {
      $this->updateOrCreateNote([], ['body' => $value]);
  }

  public function getDescriptionAttribute()
  {
      return $this->note ? $this->note->body : '';
  }
```
