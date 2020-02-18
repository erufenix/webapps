<?php
namespace Controller\WMC;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

use Symfony\Component\HttpFoundation\Request;

use Lib\Functions\Functions;

use Lib\Functions\ppPlus;


class WMCtoursController implements ControllerProviderInterface {
  private $tours;
  private $currency;

  public function __construct(){
    $this->currency = 'USD';
    $this->tours['tulum'] = array(
      'index'       => 1,
      'title'       => array(
                        'es' => 'TOURS',
                        'en' => 'TOURS',
                        'pt' => 'TOURS',
                        'fr' => 'TOURS',
                        'de' => 'TOUREN'
                      ),
      'name'        => array(
                      'es' => 'TULUM EXPRESS',
                      'en' => 'TULUM EXPRESS',
                      'pt' => 'TULUM EXPRESS',
                      'fr' => 'TULUM EXPRESS',
                      'de' => 'TULUM EXPRESS'
                    ), 
      'picture'     => 'quintanaroo-tulum.jpg',
      'banner_mail' => 'tulum_mail.png',
      'price'       => array(
                      'MX'  => '0',
                      'USD' => '65.00'
                    ),
      'description' => array(
                      'es' => '<p class="text-medium text-justify text-base-color">
                                <strong>USD por persona.<br>
                                Abierto de Lunes a Sábado</strong>
                              </p>
                              <p class="text-medium text-justify">
                                <strong>El Tulum Express incluye:</strong> Viaje de ida y vuelta desde el hotel JW Marriott y Marriott en Tulum.  Excursión de 2 horas en la zona arqueológica con guía bilingüe (1 guía por cada 25 personas) y tiempo para compras.
                              </p>
                              <div class="panel-group position-relative" id="accordion-one" role="tablist">
                                <div class="panel active" role="tab" id="accordion-one-heading-1">
                                  <div class="panel-heading ease">
                                    <div class="panel-title display-block">
                                      <a class="font-family-alt font-weight-700 letter-spacing-2 text-small text-uppercase" role="button" data-toggle="collapse" data-parent="#accordion-one" href="#accordion-one-collapse-1" aria-controls="accordion-one-collapse-1">Más información</a>
                                    </div>
                                  </div>
                                  <div id="accordion-one-collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-one-heading-1">
                                    <div class="panel-body">
                                    <p class="text-medium text-justify">
                                      Fue declarado Patrimonio de la Humanidad por la UNESCO. Uno de los sitios más importantes en Tulum es su zona arqueológica Maya, situada en un acantilado frente al Mar Caribe; con cálidas noches estrelladas y transparentes aguas color turquesa, ahí se encuentra el único sitio arqueológico que existe a la orilla del mar. Es el sitio más fotogénico de la región y quizás de todo el país.
                                    </p>
                                    <p class="text-medium text-justify">
                                      Bajo el acantilado se encuentra Playa Paraíso, considerada una de las mejores playas de la Riviera Maya, desde donde se organizan excursiones a la famosa Barrera del Arrecife Mesoamericano. La reserva de la Biósfera Sian Ka\'an mide medio millón de hectáreas y cubre todos los escenarios posibles: playas, arrecifes de coral, bosques, dunas y pozos naturales.
                                    </p>
                                    <p class="text-medium text-justify">
                                     Venga a vivir una experiencia única en uno de los Pueblos Mágicos de México.
                                    </p>
                                    <p class="text-medium text-justify">
                                      <strong>Itinerary</strong>:
                                      <ul class="text-medium text-justify">
                                        <li>08:30 a.m - Recogida en el hotel.</li>
                                        <li>10:15 a.m - Llegada a Tulum</li>
                                        <li>10:25 am – Entrada al sitio arqueológico</li>
                                        <li>10:30 am- Visita guiada</li>
                                        <li>13:00 am – Salida de Tulum</li>
                                        <li>14:45 am – Llegada al hotel.</li>
                                      </ul>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                      ',
                      'en' => '<p class="text-medium text-justify text-base-color">
                                <strong>USD per person.<br>
                                Open from Monday to Saturday</strong>
                              </p>
                              <p class="text-medium text-justify">
                                <strong>Tulum Express includes:</strong> Round trip from the JW Marriott and Marriott hotel to Tulum.  2-hour tour in the archeological zone with bilingual guide (1 guide for every 25 people) and time for shopping.
                              </p>
                              <div class="panel-group position-relative" id="accordion-one" role="tablist">
                                <div class="panel active" role="tab" id="accordion-one-heading-1">
                                  <div class="panel-heading ease">
                                    <div class="panel-title display-block">
                                      <a class="font-family-alt font-weight-700 letter-spacing-2 text-small text-uppercase" role="button" data-toggle="collapse" data-parent="#accordion-one" href="#accordion-one-collapse-1" aria-controls="accordion-one-collapse-1">More info</a>
                                    </div>
                                  </div>
                                  <div id="accordion-one-collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-one-heading-1">
                                    <div class="panel-body">
                                    <p class="text-medium text-justify">
                                      It was declared a World Heritage Site by UNESCO. One of the most important sites in Tulum is its Mayan ruins, located on a cliff facing the Caribbean Sea; with warm starry nights and clear turquoise waters lies the only archaeological site that sits on the seashore. It is the most photogenic site in the region and perhaps the whole country.
                                    </p>
                                    <p class="text-medium text-justify">
                                      Under the cliff is Paradise beach, considered one of the best beaches in the Riviera Maya, from which excursions are organized to the famous Mesoamerican Reef Barrier. The Sian Ka\'an Biosphere Reserve measures half a million hectares and covers all possible scenarios: beaches, coral reefs, rainforest, dunes and natural wells.
                                    </p>
                                    <p class="text-medium text-justify">
                                      Come to live a unique experience in one of Mexico\'s Pueblos Mágicos.
                                    </p>
                                    <p class="text-medium text-justify">
                                      <strong>Itinerary</strong>:
                                      <ul class="text-medium text-justify">
                                        <li>08:30 a.m. Pick-up at hotel.</li>
                                        <li>10:15 a.m. Arrival to Tulum</li>
                                        <li>10:25 am – Entrance to archeological site</li>
                                        <li>10:30 am- Guided tour</li>
                                        <li>13:00 am – Departure from Tulum</li>
                                        <li>14:45 am – Arrival to hotel.</li>
                                      </ul>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                      ',
                      'pt' => '',
                      'fr' => '<p class="text-medium text-justify text-base-color">
                                <strong>USD par personne.<br>
                                Ouvert du lundi au samedi</strong>
                              </p>
                              <p class="text-medium text-justify">
                                <strong>Tulum Express includes:</strong> Round trip from the JW Marriott and Marriott hotel to Tulum.  2-hour tour in the archeological zone with bilingual guide (1 guide for every 25 people) and time for shopping.
                              </p>
                              <div class="panel-group position-relative" id="accordion-one" role="tablist">
                                <div class="panel active" role="tab" id="accordion-one-heading-1">
                                  <div class="panel-heading ease">
                                    <div class="panel-title display-block">
                                      <a class="font-family-alt font-weight-700 letter-spacing-2 text-small text-uppercase" role="button" data-toggle="collapse" data-parent="#accordion-one" href="#accordion-one-collapse-1" aria-controls="accordion-one-collapse-1">Plus d\'informations</a>
                                    </div>
                                  </div>
                                  <div id="accordion-one-collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-one-heading-1">
                                    <div class="panel-body">
                                    <p class="text-medium text-justify">
                                      Tulum a été déclaré site du patrimoine mondial par l\'UNESCO. L\'un des sites les plus importants dans la région de Tulum sont ses ruines mayas, situées sur une falaise face à la mer des Caraïbes, avec des nuits étoilées et des eaux turquoises, là se trouve le seul site archéologique situé au bord de la mer. Il est le site le plus photogénique dans la région et peut-être dans l\'ensemble du pays.
                                    </p>
                                    <p class="text-medium text-justify">
                                      Sous la falaise se trouve Paradise beach, considérée comme l\'une des plus belles plages de la Riviera Maya, d\'où des excursions sont organisées vers la célèbre Barrière de Corail méso-américaine. La réserve de la biosphère de Sian Ka\'an mesure un demi-million d\'hectares et couvre tous les scénarios possibles : plages, récifs coralliens, forêts tropicales, dunes et puits naturels.
                                    </p>
                                    <p class="text-medium text-justify">
                                      Venez vivre une expérience unique dans l\'un des Villages Magiques du Mexique.
                                    </p>
                                    <p class="text-medium text-justify">
                                      <strong>Itinéraire:</strong>:
                                      <ul class="text-medium text-justify">
                                        <li>08:30 a.m. Accueil à l\'hôtel.</li>
                                        <li>10:15 a.m. Arrivée à Tulum</li>
                                        <li>10:25 am – Entrée de site archéologique</li>
                                        <li>10:30 am- Visite guidée</li>
                                        <li>13:00 am – Départ de Tulum</li>
                                        <li>14:45 am – Arrivée à l\'hôtel</li>
                                      </ul>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                      ', 
                      'de' => '<p class="text-medium text-justify text-base-color">
                                <strong>USD pro Person.<br>
                                Geöffnet von Montag bis Samstag</strong>
                              </p>
                              <p class="text-medium text-justify">
                                <strong>Tulum Express beinhaltet:</strong> Rundfahrt vom JW Marriott und Marriott Hotel nach Tulum.  2-stündige Tour in der archäologischen Zone mit zweisprachigem Reiseleiter (1 Reiseleiter pro 25 Personen) und Zeit zum Einkaufen.
                              </p>
                              <div class="panel-group position-relative" id="accordion-one" role="tablist">
                                <div class="panel active" role="tab" id="accordion-one-heading-1">
                                  <div class="panel-heading ease">
                                    <div class="panel-title display-block">
                                      <a class="font-family-alt font-weight-700 letter-spacing-2 text-small text-uppercase" role="button" data-toggle="collapse" data-parent="#accordion-one" href="#accordion-one-collapse-1" aria-controls="accordion-one-collapse-1">Weitere Informationen</a>
                                    </div>
                                  </div>
                                  <div id="accordion-one-collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-one-heading-1">
                                    <div class="panel-body">
                                    <p class="text-medium text-justify">
                                      Sie wurde von der UNESCO zum Weltkulturerbe erklärt. Eine der wichtigsten Stätten in Tulum sind die Maya-Ruinen, die sich auf einer Klippe mit Blick auf das Karibische Meer befinden; mit warmen sternenklaren Nächten und klarem türkisfarbenem Wasser liegt die einzige archäologische Stätte, die sich am Meer befindet. Es ist der beliebteste Ort fur Fotografen in der Region und vielleicht vom ganzen Land.
                                    </p>
                                    <p class="text-medium text-justify">
                                      Unter der Klippe befindet sich der Paradiesstrand, der als einer der besten Strände der Riviera Maya gilt, von dem aus Ausflüge zum berühmten mesoamerikanischen Korallenriff organisiert werden. Das Biosphärenreservat Sian Ka\'an umfasst eine halbe Million Hektar und deckt alle möglichen Szenarien ab: Strände, Korallenriffe, Regenwald, Dünen und Naturquellen.
                                    </p>
                                    <p class="text-medium text-justify">
                                     Erleben Sie eine einzigartige Erfahrung in einem der mexikanischen magischen Dörfer.
                                    </p>
                                    <p class="text-medium text-justify">
                                      <strong>Reiseverlauf:</strong>:
                                      <ul class="text-medium text-justify">
                                        <li>08:30 Uhr - Abholung vom Hotel</li>
                                        <li>10:15 Uhr - Ankunft in Tulum</li>
                                        <li>10:25 Uhr - Eingang zur archäologischen Stätte</li>
                                        <li>10:30 Uhr - Geführte Tour</li>
                                        <li>13:00 Uhr - Abreise aus Tulum</li>
                                        <li>14:45 Uhr - Ankunft im Hotel</li>
                                      </ul>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                      '                                           
                    )
    );

    $this->tours['chichenitza'] = array(
      'index'       => 2,
      'name'        => array(
                      'es' => 'CHICHEN ITZA',
                      'en' => 'CHICHEN ITZA',
                      'pt' => 'CHICHEN ITZA',
                      'fr' => 'CHICHEN ITZA',
                      'de' => 'CHICHEN ITZA'
                    ), 
      'picture'     => 'CHICHENITZA.png',
      'banner_mail' => 'chichenitza_mail.png',
      'price'       => array(
                      'MX'  => '0',
                      'USD' => '125.00'
                    ),
      'description' => array(
                      'es' => '<p class="text-medium text-justify text-base-color">
                                <strong>USD per person.<br>
                                Open from Monday to Saturday</strong>
                              </p>
                              <p class="text-medium text-justify">
                                <strong>The services include:</strong>
                                  <ul class="text-medium text-justify">
                                    <li>Transporte de ida y vuelta Hotel Chichen Itzá - Hotel</li>
                                    <li>Entrada a Chichen Itzá</li>
                                    <li>Visita guiada a Chichen Itzá y tiempo libre</li>
                                    <li>Almuerzo buffet regional</li>
                                    <li>Nadar en un Cenote</li>
                                  </ul>
                                </p>
                              <p class="text-medium text-justify">
                                <strong>Does not included:</strong>
                                <ul class="text-medium text-justify">
                                  <li>Souvenirs, Propinas $5.00 USD por persona, Bebidas en el almuerzo, uso de la cámara o el vídeo en la zona arqueológica</li>
                                  <li>Recomendaciones: ropa cómoda y zapatos de caminata, gorra.</li>
                                </ul>
                              </p>
                              <div class="panel-group position-relative" id="accordion-one" role="tablist">
                                <div class="panel" role="tab" id="accordion-one-heading-1">
                                  <div class="panel-heading ease">
                                    <div class="panel-title display-block">
                                      <a class="font-family-alt font-weight-700 letter-spacing-2 text-small text-uppercase" role="button" data-toggle="collapse" data-parent="#accordion-one" href="#accordion-one-collapse-1" aria-controls="accordion-one-collapse-1">Más información</a>
                                    </div>
                                  </div>
                                  <div id="accordion-one-collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-one-heading-1">
                                    <div class="panel-body">
                                      <p class="text-medium text-justify">¡Visite una de las Siete Nuevas Maravillas del Mundo y experimente el mejor tour de Chichen Itzá en Cancún y la Riviera Maya! Chichen Itzá es un lugar mágico, con mucha historia y hechos curiosos que descubrir durante la visita guiada, admirando al mismo tiempo los hermosos templos y construcciones. Viaje en transporte con aire acondicionado, visite el sitio arqueológico durante una visita guiada de 2h30 con breves descansos para tomar fotos, disfrute de un almuerzo buffet en un restaurante local, visite y nade en el hermoso cenote de Hacienda Selva Maya. ¡Esto es algo que no debe perderse durante sus vacaciones mexicanas!</p>
                                      <p class="text-medium text-justify">
                                        <strong>Itinerary</strong>:
                                        <ul class="text-medium text-justify">
                                          <li>07:00 hrs. Recogida en el hotel.</li>
                                          <li>10:00 hrs. Llegada a Chichen Itzá</li>
                                          <li>110:15 hrs: Visita guiada</li>
                                          <li>11:15 hrs: Tiempo Libre</li>
                                          <li>12:30 hrs: Termina tour arqueológico</li>
                                          <li>13:00 hrs: Llegada al cenote y tiempo para comer</li>
                                          <li>15:00 hrs: Salida de Chichen Itzá</li>
                                          <li>18:00 hrs: Llegada al hotel</li>
                                        </ul>
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                      ',
                      'en' => '<p class="text-medium text-justify text-base-color">
                                <strong>USD per person.<br>
                                Open from Monday to Saturday</strong>
                              </p>
                              <p class="text-medium text-justify">
                                <strong>The services include:</strong>
                                  <ul class="text-medium text-justify">
                                    <li>Roundtrip transportation Hotel- Chichen Itza - Hotel</li>
                                    <li>Entrance to Chichen Itza</li>
                                    <li>Guided Tour at Chichen Itza and free time</li>
                                    <li>Regional buffett Lunch</li>
                                    <li>Swim in Cenote</li>
                                  </ul>
                                </p>
                              <p class="text-medium text-justify">
                                <strong>Does not included:</strong>
                                <ul class="text-medium text-justify">
                                  <li>Souvenirs, Gratuities $5.00 USD per person, Beverage at lunch, use of Camera or video into the Arqueological Zone.</li>
                                  <li>Recommendations: comfortable clothing and shoes for walking, cap</li>
                                </ul>
                              </p>
                              <div class="panel-group position-relative" id="accordion-one" role="tablist">
                                <div class="panel" role="tab" id="accordion-one-heading-1">
                                  <div class="panel-heading ease">
                                    <div class="panel-title display-block">
                                      <a class="font-family-alt font-weight-700 letter-spacing-2 text-small text-uppercase" role="button" data-toggle="collapse" data-parent="#accordion-one" href="#accordion-one-collapse-1" aria-controls="accordion-one-collapse-1">More info</a>
                                    </div>
                                  </div>
                                  <div id="accordion-one-collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-one-heading-1">
                                    <div class="panel-body">
                                      <p class="text-medium text-justify">Visit one of the New Seven Wonders of the World and experience the best Chichen Itza tour in Cancun and the Riviera Maya! Chichen Itza is a magical place with a lot of history and curious facts that you discover during the guided tour while admiring the beautiful temples and constructions. Travel in transportation with A/C, visit the archaeological site during a 2h30 guided visit with short breaks to take pictures, enjoy lunch buffet at a local restaurant, visit and swim in the beautiful cenote of Hacienda Selva Maya. This is a must do during your Mexican holidays!</p>
                                      <p class="text-medium text-justify">
                                        <strong>Itinerary</strong>:
                                        <ul class="text-medium text-justify">
                                          <li>07:00 hrs. Pick-up at hotel.</li>
                                          <li>10:00 hrs. Arrival to Chichen-Itza</li>
                                          <li>110:15 hrs: Guided Tour</li>
                                          <li>11:15 hrs: Free time</li>
                                          <li>12:30 hrs: Ends arqueological tour</li>
                                          <li>13:00 hrs: Arrival to cenote and time for food</li>
                                          <li>15:00 hrs: Departure from Chichen-Itza</li>
                                          <li>18:00 hrs: Arrival to hotel</li>
                                        </ul>
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                      ',
                     'fr' => '<p class="text-medium text-justify text-base-color">
                                <strong>
                                  USD par personne.<br>
                                  Ouvert du lundi au samedi
                                </strong>
                              </p>
                              <p class="text-medium text-justify">
                                <strong>Les services comprennent: </strong>
                                <ul class="text-medium text-justify">
                                  <li>Transport aller-retour hôtel- Chichen Itza - hôtel</li>
                                  <li>Entrée à Chichen Itza</li>
                                  <li>Visite guidée de Chichen Itza et temps libre</li>
                                  <li>Déjeuner buffet régional</li>
                                  <li>Baignade dans le cénote</li>
                                </ul>
                              </p>
                              <p class="text-medium text-justify">
                                <strong>Non inclus:</strong>
                                <ul class="text-medium text-justify">
                                  <li>Souvenirs, pourboires (de $5 USD par personne), boissons au déjeuner et l\'utilisation de l\'appareil photo ou vidéo dans la zone arquéologique.</li>
                                  <li>Recommandations : vêtements et chaussures confortables pour la marche, casquette.</li>
                                </ul>
                              </p>
                              <div class="panel-group position-relative" id="accordion-one" role="tablist">
                                <div class="panel" role="tab" id="accordion-one-heading-1">
                                  <div class="panel-heading ease">
                                    <div class="panel-title display-block">
                                      <a class="font-family-alt font-weight-700 letter-spacing-2 text-small text-uppercase" role="button" data-toggle="collapse" data-parent="#accordion-one" href="#accordion-one-collapse-1" aria-controls="accordion-one-collapse-1">Plus d\'informations</a>
                                    </div>
                                  </div>
                                <div id="accordion-one-collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-one-heading-1">
                              <div class="panel-body">
                                <p class="text-medium text-justify">Visitez l\'une des nouvelles Sept Merveilles du monde et vivez l\'expérience du meilleur tour de Chichen Itza à Cancun et sur la Riviera Maya ! Chichen Itza est un lieu magique avec beaucoup d\'histoire et de faits curieux que vous découvrirez au cours de la visite guidée tout en admirant les magnifiques temples et constructions. Voyagez dans un véhicule climatisé, visitez le site archéologique au cours d\'une visite guidée de 2h30 avec de courtes pauses pour prendre des photos, profitez d\'un déjeuner buffet dans un restaurant local, de la promenade et baignade dans le magnifique cénote de Hacienda Selva Maya. C\'est un incontournable pendant vos vacances au Mexique !</p>
                                <p class="text-medium text-justify"><strong>Itinéraire :</strong>:
                                  <ul class="text-medium text-justify">
                                    <li>07:00 hrs. Accueil à l\'hôtel.</li>
                                    <li>10:00 hrs. Arrivée à Tulum Chichen-Itza</li>
                                    <li>10:15 hrs: Visite guidée</li>
                                    <li>11:15 hrs: Temps libre</li>
                                    <li>12:30 hrs: Fin de la visite arquéologique</li>
                                    <li>13:00 hrs: Arrivée au cénote et temps pour le repas</li>
                                    <li>15:00 hrs: Départ de Chichen-Itza</li>
                                    <li>18:00 hrs: Arrivée à l\'hôtel</li>
                                  </ul>
                                </p>
                            </div>
                          </div>
                        </div>
                        </div>
                      ',
                    'de' => '<p class="text-medium text-justify text-base-color">
                                <strong>
                                  USD par personne.<br>
                                  Ouvert du lundi au samedi
                                </strong>
                              </p>
                              <p class="text-medium text-justify">
                                <strong>Die Dienstleistungen umfassen: </strong>
                                <ul class="text-medium text-justify">
                                  <li>Hin- und Rücktransport Hotel - Chichen Itza - Hotel</li>
                                  <li>Eingang zu Chichen Itza</li>
                                  <li>Geführte Tour in Chichen Itza und Freizeit</li>
                                  <li>Regionales Buffet Mittagessen</li>
                                  <li>Schwimmen in einem Cenote (Unteriridschem Fluss)</li>
                                </ul>
                              </p>
                              <p class="text-medium text-justify">
                                <strong>Non inclus:</strong>
                                <ul class="text-medium text-justify">
                                  <li>Souvenirs, Trinkgelder $5.00 USD pro Person, Getränke zum Mittagessen, Verwendung von Kamera oder Video in der archäologischen Stätte</li>
                                  <li>Empfehlungen: Bequeme Kleidung und Schuhe zum Gehen, Mütze.</li>
                                </ul>
                              </p>
                              <div class="panel-group position-relative" id="accordion-one" role="tablist">
                                <div class="panel" role="tab" id="accordion-one-heading-1">
                                  <div class="panel-heading ease">
                                    <div class="panel-title display-block">
                                      <a class="font-family-alt font-weight-700 letter-spacing-2 text-small text-uppercase" role="button" data-toggle="collapse" data-parent="#accordion-one" href="#accordion-one-collapse-1" aria-controls="accordion-one-collapse-1">Weitere Informationen</a>
                                    </div>
                                  </div>
                                <div id="accordion-one-collapse-1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-one-heading-1">
                              <div class="panel-body">
                                <p class="text-medium text-justify">Besuchen Sie eines der neuen sieben Weltwunder und erleben Sie die beste Chichen Itza Tour in Cancun und der Riviera Maya! Chichen Itza ist ein magischer Ort mit viel Geschichte und kuriosen Fakten, die Sie während der Führung entdecken und dabei die schönen Tempel und Bauwerke bewundern. Reisen Sie mit Klimaanlage, besuchen Sie die archäologische Stätte während einer 2h30 geführten Besichtigung mit kurzen Pausen zum Fotografieren, genießen Sie das Mittagsbuffet in einem lokalen Restaurant, besuchen und schwimmen Sie in der schönen Cenote (unterirdischem Fluss) der Hacienda Selva Maya. Dies ist ein Muss während Ihrer mexikanischen Ferien!</p>
                                <p class="text-medium text-justify"><strong>Reiseverlauf:</strong>:
                                  <ul class="text-medium text-justify">
                                    <li>07:00 Uhr. Abholung vom Hotel.</li>
                                    <li>10:00 Uhr. Ankunft in Chichen-Itza</li>
                                    <li>110:15 Uhr: Geführte Tour</li>
                                    <li>11:15 Uhr: Freie Zeit</li>
                                    <li>12:30 Uhr: Beendet die archäologische Tour</li>
                                    <li>13:00 Uhr: Ankunft am Cenote (unteriridischen Fluss) und Zeit für das Essen</li>
                                    <li>15:00 Uhr: Abfahrt von Chichen-Itza aus</li>
                                    <li>18:00 Uhr: Ankunft im Hotel</li>
                                  </ul>
                                </p>
                            </div>
                          </div>
                        </div>
                        </div>
                      ',
                      'pt' => ''
                     )  
    );    

    /*$this->tours['coba'] = array(
      'index'       => 1,
      'name'        => array(
                      'es' => 'COBA VILLAGE',
                      'en' => 'COBA VILLAGE',
                      'pt' => 'COBA VILLAGE'
                    ), 
      'picture'     => 'coba.jpg',
      'price'       => array(
                      'mx'  => '0',
                      'usd' => '137.00'
                    ),
      'description' => array(
                      'es' => '',
                      'en' => '<strong>The expedition includes:</strong> transportation in small groups, traditional lunch, water, archaeological tour guide, entrance fee to Coba, towels and lockers. <br><br><span class="text-base-color">USD per person</span><br>
                      <span class="text-base-color">Open from Monday to Saturday</span><br>',
                      'pt' => ''
                     )  
    );*/

    $this->froms  = array(
                      'es' => array(
                                'name'              => 'Nombre',
                                'surname'           => 'Apellidos',
                                'email'             => 'Correo electrónico',
                                'tour_date'         => 'Fecha',
                                'companion'         => 'Acompañantes (máximo 4 personas)',
                                'companion_name'    => 'Nombre del acompañante',
                                'companion_email'   => 'Correo del acompañante',
                                'tour_data'         => 'Datos del Tour',
                                'msg1'              => 'The data is correct? Click <strong>Continue</strong> to process the data and proceed with the payment, to change them click <strong>Back</strong>',
                                'next'              => 'Siguiente',
                                'continue'          => 'Continuar',
                                'back'              => 'Regresar',
                                'pay'               => 'Pagar'
                              ),
                      'en' => array(
                                'name'              => 'Name',
                                'surname'           => 'Surname',
                                'email'             => 'Email',
                                'tour_date'         => 'Date',
                                'companion'         => 'Companions (4 people maximum)',
                                'companion_name'    => 'Companion full name',
                                'companion_email'   => 'Companion email',
                                'tour_data'         => 'Tour data',
                                'msg1'              => 'The data is correct? Click <strong>Continue</strong> to process the data and proceed with the payment, to change them click <strong>Back</strong>',
                                'next'              => 'Next',
                                'continue'          => 'Continue',
                                'back'              => 'Back',
                                'pay'               => 'Pay'
                              ),
                      'pt' => 'TOURS',
                      'fr' => array(
                                'name'              => 'Nom',
                                'surname'           => 'Nom de familie',
                                'email'             => 'Email',
                                'tour_date'         => 'Date',
                                'companion'         => 'Compagnons (maximum 4 personnes)',
                                'companion_name'    => 'Nom complet du compagnon',
                                'companion_email'   => 'Compagnon Mail',
                                'tour_data'         => 'Données de tournée',
                                'msg1'              => 'Les données sont-elles correctes? cliquez sur <strong>Continuer</strong> pour procéder au paiement. Pour les modifications, cliquez sur <strong>Retour</strong>',
                                'next'              => 'Précédent',
                                'continue'          => 'Continuer',
                                'back'              => 'Retour',
                                'pay'               => 'Payer'
                              ),
                      'de' => array(
                                'name'              => 'Vorname',
                                'surname'           => 'Nachname',
                                'email'             => 'E-mail',
                                'tour_date'         => 'Datum',
                                'companion'         => 'Begleiter (maximal 4 Personen)',
                                'companion_name'    => 'Name des Begleiters',
                                'companion_email'   => 'Begleiter E-Mail',
                                'tour_data'         => 'Tourdaten',
                                'msg1'              => 'Sind die Daten korrekt? Klicken Sie auf <strong>Weiter</strong>, um die Daten zu verarbeiten und mit der Zahlung fortzufahren. Klicken Sie auf <strong>Zurück</strong>, um sie zu ändern',
                                'next'              => 'Weiter',
                                'continue'          => 'Weiter',
                                'back'              => 'Zurück',
                                'pay'               => 'Zahlen'
                      ),                      
    );

    $this->menus  = array(
                      'es' => array(
                              'contact' => 'Contacto',
                              'back'    => 'Regresar',
                              'credits' => '© T&C GROUP NUEVAS TECNOLOGÍAS TODOS LOS DERECHOS RESERVADOS. 2020 | WORLD MEAT CONGRESS'
                      ),
                      'en' => array(
                              'contact' => 'Contact',
                              'back'    => 'Back',
                              'msg'     => '© T&C GROUP NUEVAS TECNOLOGÍAS ALL RIGHTS RESERVED. 2020 | WORLD MEAT CONGRESS'
                      ),
                      'fr' => array(
                              'contact' => 'Contact',
                              'back'    => 'Retour',
                              'msg'     => '© T&C GROUP NUEVAS TECNOLOGÍAS TOUS DROITS RÉSERVÉS. 2020 | WORLD MEAT CONGRESS'
                      ),
                      'de' => array(
                              'contact' => 'Kontakt',
                              'back'    => 'Back',
                              '© T&C GROUP NUEVAS TECNOLOGÍAS ALLE RECHTE VORBEHALTEN. 2020 | WORLD MEAT CONGRESS'
                      )                                          
                    );  

    $this->plang = array(
      'es' => 'es_MX',
      'en' => 'en_US',
      'pt' => 'pt_BR',
      'fr' => 'fr_FR',
      'de' => 'de_DE'
    );    

  }

  public function connect(Application $app) {
    $index = $app['controllers_factory'];
		$index
			->get('/{tour}/{lang}','Controller\WMC\WMCtoursController::index')
        ->bind('WMCtours.index')
        ->assert('tour', '\w+')->value('tour', 'tulum')
        ->assert('lang', '\w+')->value('lang', 'en');
    $index->post('/checkout/','Controller\WMC\WMCtoursController::checkout')
    ->bind('WMCtours.checkout');    
		$index->post('/payComplete/','Controller\WMC\WMCtoursController::payComplete')
			->bind('WMCtours.payComplete')
      ->assert('lang', '\w+')->value('lang', 'en');
    $index->post('/payCancel/{lang}','Controller\WMC\WMCtoursController::payCancel')
			->bind('WMCtours.payCancel')
      ->assert('lang', '\w+')->value('lang', 'en');
    $index->get('/payExecute/','Controller\WMC\WMCtoursController::payExecute')
			->bind('WMCtours.payExecute');              
    return $index;
  }

  public function index(Request $request, Application $app,$tour,$lang) {
    return $app['twig']->render('pages/WMC/index.twig', array(
      'rq'        => $request,
      'tour'      => $tour,
      'lang'      => $lang,
      'tours'     => $this->tours,
      'currency'  => $this->currency,
      'forms'     => $this->froms
     ));
  }

  public function checkout(Request $request, Application $app){
    $response     = array();
    $tourdata     = $request->request->All();
    $tourname     = $request->request->get('tour_name');
    $tourinfo     = $this->tours[$tourname];
    $tourRname    = $tourinfo['name'][$request->request->get('lang')];
    $payData 			= array();
		$lang 				= $this->plang[$request->request->get('lang')];
    $urls 				= array();
    $total        = 0;
    $subTotal     = $tourinfo['price'][$this->currency] * 1;
    $companion    = 0;
    $companions   = array();
    $fn 			    = new Functions;
    $sku          = $fn->token(6,'WMCtour_');
		$settings = array(
      'mode' 			=> 'sandbox',
      'clientID' 	=> array(
                        'sandbox' => 'ATRlwj29eLlkCfnbXcVnuBxmKyISuUzZCTIhCFc-tyo_8ucLxAtdABEyMseGGelDD1mrXNJca938JePw',
                        'live' 		=> 'AX4F5-EOloUwKXnhgNGcMigiFrwVUUbF3kaVHJgk5dDY-5JRf7glVyq2f8psi0QXCLSSYp-aKxM7PS2A'
                      ),
      'secret' 		=> array(
                        'sandbox' => 'EAhILjAqrzGkp63Woew2l9H73mphTLpPyChr_opX_ADnWX6uaJbYj-QfRazOmozNQrk0_ubKr8LaTo7U',
                        'live' 		=> 'EE8KjGC0PCt-Nz7hpGE_sYKVDIogwqILyvzaOJLMCYyALKvMSDBmwJUqv_SOnYPjwwrilxfxhgOftLq6'
                      ),
      'params' 		=> array(
                        'nameProfile' => 'WMCtours_' . uniqid(),
                        'logoImage' 	=> 'https://webapps.tycgroup.com/assets/img/logoTyC50.png',
                        'shipping' 		=> 1,
                        'address' 		=> 1,
                        'landingPage' => 'billing',
                        'bank' 				=> 'https://www.paypal.com'
                      )
    );
    $ppPlus 		= new ppPlus($settings);
    foreach ($tourdata[cfullname] as $kp => $vp) {
      if($vp != ''){
        $companion++;
        $companions[$kp]['name']  = $tourdata[cfullname][$kp];
        $companions[$kp]['email'] = $tourdata[cemail][$kp];
      }
    }
		$urls 			= array(
      'return' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate('WMCtours.payComplete')),
      'cancel' => sprintf("%s://%s",(!empty($request->server->get('HTTPS')) && $request->server->get('HTTPS') == 'on') ? 'https' : 'http',$app['url_generator']->generate('WMCtours.payCancel'))
    );
    $total = (1 + $companion) *  $subTotal;
		$payData = array(
      'currency'					=> $this->currency,
      'total' 						=> $total,
      'subTotal' 					=> $subTotal,
      'description' 			=> "WMC Tour " . $tourRname . ", " . $tourdata['name'] . " " . $tourdata['surname'] .", $companion companions", 
      'name' 							=> $tourdata['name'] . " " . $tourdata['surname'],
      'address1' 					=> "Ángel Urraza 625, Del Valle",
      'address2' 					=> "",
      'city' 							=> "CDMX",
      'country_code' 			=> "MX",
      'cp' 								=> "03100",
      'state' 						=> "CDMX",
      'phone' 						=> "5551487500",
      'item_name' 				=> "WMC Tour $tourRname",
      'item_description' 	=> "WMC Tour " . $tourRname . ", " . $tourdata['name'] . " " . $tourdata['surname'] .", $companion companions",
      'item_price' 				=> $total,
      'item_sku' 					=> $sku,
      'item_currency' 		=> $this->currency
    );

    $tourdata['phone']      = $payData['phone'];
    $tourdata['companion'] = $companion;
    $tourdata['companions'] = $companions;
    $tourdata['subtotal']   = $subTotal;
    $tourdata['total']      = $total;
    $tourdata['rname']      = $tourRname;
    $tourdata['sku']        = $sku;
    $response = array(
      'approval' => $ppPlus->getApproval($payData,$urls,$lang),
      'tourdata' => $tourdata,
      'tourinfo' => $tourinfo 
    );
    return $app->json($response);   
  }

	public function payComplete(Request $request, Application $app,$lang){
    $mail	  = \Swift_Message::newInstance();
    $model  =	$app["wmcModel"];
    $mail
    ->setTo($request->request->get('data')['tourdata']['email'],$request->request->get('data')['tourdata']['name'] . " " . $request->request->get('data')['tourdata']['surname'])
    ->setBcc(array(
        "erubi@tycgroup.com" => "Edgar Rubi"
    ))
    ->setFrom('no--reply@sin-tcevents.mx','WMC Tours')
    ->setSubject('WMC Tours - Payment completed');
    $body = $app['twig']->render('pages/WMC/mail.twig', array(
      "data"			=> $request->request->All()
      )
    );
    $mail->setBody($body, "text/html");			
    $env_cli = $app['mailer']->send($mail);

    $reg = $model->setTour($request->request->All());
    
    return $app['twig']->render('pages/WMC/complete.twig', array(
      'obj'        => $request->request->All()
    ));
  }
  
	public function payCancel(Request $request, Application $app,$lang){
		return true;
  }
  
	public function payExecute(Request $request, Application $app){
		$ppPlus 	= new ppPlus(array());
		$exeUrl 	= $request->query->get('exeUrl');
		$payerId 	= $request->query->get('payer_id');
    $token 		= $request->query->get('token');
		return $app->json($ppPlus->execute($exeUrl,$token,$payerId));
	}  

}
?>