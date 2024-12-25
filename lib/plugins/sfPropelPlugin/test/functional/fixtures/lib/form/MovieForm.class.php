<?php

/**
 * Movie form.
 *
 */
class MovieForm extends BaseMovieForm
{
  public function configure()
  {
    $this->embedI18n(['en', 'fr']);
  }
}
