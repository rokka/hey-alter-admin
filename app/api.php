<?php

/**
 * @OA\Info(
 *    title="Hey, Neuer! API",
 *    description="Über die 'Hey, Neuer! API' können die Daten der Webseite [Hey, Neuer!](https://heyalter.mauve.de) verarbeitet werden.",
 *    version="0.0.1",
 *    @OA\Contact(
 *        email="essen@heyalter.com"
 *   )
 * )
 * @OA\SecurityScheme(
*      securityScheme="bearerAuth",
*      in="header",
*      name="bearerAuth",
*      type="http",
*      scheme="bearer",
*      bearerFormat="JWT",
* ),
 */