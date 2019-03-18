/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: IT
 */
jQuery.extend(jQuery.validator.messages, {
       required: "Campo obbligatorio.",
       remote: "Controlla questo campo.",
       email: "Inserisci un indirizzo email valido.",
       url: "Inserisci un indirizzo web valido.",
       date: "Inserisci una data valida.",
       dateISO: "Inserisci una data valida (ISO).",
       number: "Inserisci un numero valido.",
       digits: "Inserisci solo numeri.",
       creditcard: "Inserisci un numero di carta di credito valido.",
       equalTo: "Il valore non corrisponde.",
       accept: "Inserisci un valore con un&apos;estensione valida.",
       maxlength: jQuery.validator.format("Non inserire pi&ugrave; di {0} caratteri."),
       minlength: jQuery.validator.format("Inserisci almeno {0} caratteri."),
       rangelength: jQuery.validator.format("Inserisci un valore compreso tra {0} e {1} caratteri."),
       range: jQuery.validator.format("Inserisci un valore compreso tra {0} e {1}."),
       max: jQuery.validator.format("Inserisci un valore minore o uguale a {0}."),
       min: jQuery.validator.format("Inserisci un valore maggiore o uguale a {0}."),

       exactlength: jQuery.validator.format("Inserisci un valore di {0} caratteri."),
       kohana_pattern: jQuery.validator.format("Formato non valido"),
		 
		 greaterThan: jQuery.format('Deve essere maggiore dell\'altra data.'),
   	 greaterEqualThan: jQuery.format('Deve essere maggiore o uguale dell\'altra data.'),
		 integer: jQuery.format('Il valore deve essere composto da cifre (0-9)')
    
});