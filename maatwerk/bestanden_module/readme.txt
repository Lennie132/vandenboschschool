  /**
   * Zet deze gehele map 'bestanden_module' in de map 'maatwerk' van jouw site.
   * Maak een maatwerk blok aan en link naar 'maatwerk/bestanden_module/index.php'.
   * 
   * Voorbeeld gebruik van deze module:
   *  - vandenboschschool2016
   * 
   * Deze module heeft minimaal de tabellen:
   *  - art_bestandenmodule
   *    > titel (Text, verplicht, taalgevoelig);
   *    > bestand (Bestand);
   *    
   *  - art_bestandenmodule_eigenschappen
   *    > kleur (Dropdown uit db, SELECT kleurcode, kleur FROM art_kleuren);
   *    
   *  - art_kleuren (Kleuren voor mappen/groepen)
   *    > kleur (Text);
   *    > kleurcode (Kleurenpallet);
   * 
   * Deze lcms variabelen zijn er nodig:
   *  - page_bestandenmodule (pagina_id waar deze module wordt gebruikt)
   *  - bestandenmodule_gebruik_login (true of false)
   * 
   * De bezoekersmodule kan gebruikt worden voor deze module,
   * vink hiervoor op de pagina zichtbaar->login aan, en zet de variabele 'bestandenmodule_gebruik_login' op true.
   * 
   * @author Lennart Veringmeier
   * @date 13-12-2016
   */