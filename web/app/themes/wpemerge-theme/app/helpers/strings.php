<?php

/**
 * Replace all characters besides letters and numbers to spaces
 *
 * @param  string  $filename
 *
 * @return string
 */
function app_only_words(string $filename): string
{
	return trim(preg_replace('/[^A-z0-9]+|_/', ' ', $filename));
}

function app_remove_file_extension(string $filename): string
{
	return trim(preg_replace('/\.[^.]+/', '', $filename));
}
