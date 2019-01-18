# Cupparijs 4 

Libreria per la costruzione di interfacce single page e costruzioni di componenti riusabili in contesti 
diversi e gestione delle route per scambio di dati con server con protocollo json.

<a href="http://pierpaolociullo.it/help">Help</a>

## Dipendenze

Per poter essere utilizzata la libreria ha bisogno delle seguenti risorse

- bootstrap >= 3.3.7
- jquery >= 2.2.4
- font-awesome >= 4.7.0
- underscore >= 1.8.3

Per comodità ho inserito nel folder cupparijs/libs le versioni sopracitate.

## Installazione

Nella cartella plugins ci sono i javascript di base per l'ulitizzo di alcuni componenti renders come 
texthtml e autocomplete. Questa cartella è il contenitore per i plugins che vogliamo utilizzare nella nostra
applicazione e può essere estesa secondo le proprie esigenze e i propri renders. Sotto un esempio per l'installazione della
libreria. Copiare la cartella `cupparijs` nella root del vostra applicazione web.

```html
<head>
    <!-- bootstrap e font-awesome css -->
    <link href="/cupparijs/libs/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/cupparijs/libs/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/cupparijs/libs/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- bootstrap, undescore e jquery -->
    <script src="/cupparijs/libs/jquery-2.2.4.min.js"></script>
    <script src="/cupparijs/libs/underscore-min.js"></script>
    <script src="/cupparijs/libs/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    
    <link href="/cupparijs/cupparijs4.1.css" rel="stylesheet">
    <script src="/cupparijs/cupparijs-4.1-min.js"></script>
</head>
<body>
    <script>
        app = new App();
        app.pluginsPath = '/cupparijs/plugins/';
        app.resources = [
            "moment-with-locales.min.js",
        ]
        app.init({
            showLog : true
        });
    </script>
</body>
```