<?php

return [

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

'accepted' => ':attribute måste accepteras.',
'accepted_if' => ':attribute måste accepteras när :other är :value.',
'active_url' => ':attribute är inte en giltig URL.',
'after' => ':attribute måste vara ett datum efter :date.',
'after_or_equal' => ':attribute måste vara ett datum efter eller lika med :date.',
'alpha' => ':attribute får endast innehålla bokstäver.',
'alpha_dash' => ':attribute får endast innehålla bokstäver, siffror, bindestreck och understreck.',
'alpha_num' => ':attribute får endast innehålla bokstäver och siffror.',
'array' => ':attribute måste vara en array.',
'ascii' => ':attribute får endast innehålla enkla alfanumeriska tecken och symboler.',
'before' => ':attribute måste vara ett datum före :date.',
'before_or_equal' => ':attribute måste vara ett datum före eller lika med :date.',
'between' => [
    'array' => ':attribute måste ha mellan :min och :max objekt.',
    'file' => ':attribute måste vara mellan :min och :max kilobyte.',
    'numeric' => ':attribute måste vara mellan :min och :max.',
    'string' => ':attribute måste vara mellan :min och :max tecken.',
],
'boolean' => ':attribute måste vara sant eller falskt.',
'can' => ':attribute innehåller ett ogiltigt värde.',
'confirmed' => ':attribute bekräftelse matchar inte.',
'contains' => ':attribute saknar ett obligatoriskt värde.',
'current_password' => 'Lösenordet är felaktigt.',
'date' => ':attribute är inte ett giltigt datum.',
'date_equals' => ':attribute måste vara ett datum lika med :date.',
'date_format' => ':attribute matchar inte formatet :format.',
'decimal' => ':attribute måste ha :decimal decimaler.',
'declined' => ':attribute måste avböjas.',
'declined_if' => ':attribute måste avböjas när :other är :value.',
'different' => ':attribute och :other måste vara olika.',
'digits' => ':attribute måste vara :digits siffror.',
'digits_between' => ':attribute måste vara mellan :min och :max siffror.',
'dimensions' => ':attribute har ogiltiga bilddimensioner.',
'distinct' => ':attribute har ett duplicerat värde.',
'doesnt_end_with' => ':attribute får inte sluta med något av följande: :values.',
'doesnt_start_with' => ':attribute får inte börja med något av följande: :values.',
'email' => ':attribute måste vara en giltig e-postadress.',
'ends_with' => ':attribute måste sluta med något av följande: :values.',
'enum' => 'Den valda :attribute är ogiltig.',
'exists' => 'Den valda :attribute är ogiltig.',
'extensions' => ':attribute måste vara en fil av typen: :values.',
'file' => ':attribute måste vara en fil.',
'filled' => ':attribute måste ha ett värde.',
'gt' => [
    'array' => ':attribute måste ha fler än :value objekt.',
    'file' => ':attribute måste vara större än :value kilobyte.',
    'numeric' => ':attribute måste vara större än :value.',
    'string' => ':attribute måste vara längre än :value tecken.',
],
'gte' => [
    'array' => ':attribute måste ha :value objekt eller fler.',
    'file' => ':attribute måste vara större än eller lika med :value kilobyte.',
    'numeric' => ':attribute måste vara större än eller lika med :value.',
    'string' => ':attribute måste vara längre än eller lika med :value tecken.',
],
'hex_color' => ':attribute måste vara en giltig hexadecimal färg.',
'image' => ':attribute måste vara en bild.',
'in' => 'Den valda :attribute är ogiltig.',
'in_array' => ':attribute finns inte i :other.',
'integer' => ':attribute måste vara ett heltal.',
'ip' => ':attribute måste vara en giltig IP-adress.',
'ipv4' => ':attribute måste vara en giltig IPv4-adress.',
'ipv6' => ':attribute måste vara en giltig IPv6-adress.',
'json' => ':attribute måste vara en giltig JSON-sträng.',
'list' => ':attribute måste vara en lista.',
'lowercase' => ':attribute måste vara med små bokstäver.',
'lt' => [
    'array' => ':attribute måste ha färre än :value objekt.',
    'file' => ':attribute måste vara mindre än :value kilobyte.',
    'numeric' => ':attribute måste vara mindre än :value.',
    'string' => ':attribute måste vara kortare än :value tecken.',
],
'lte' => [
    'array' => ':attribute får inte ha fler än :value objekt.',
    'file' => ':attribute måste vara mindre än eller lika med :value kilobyte.',
    'numeric' => ':attribute måste vara mindre än eller lika med :value.',
    'string' => ':attribute måste vara kortare än eller lika med :value tecken.',
],
'mac_address' => ':attribute måste vara en giltig MAC-adress.',
'max' => [
    'array' => ':attribute får inte ha fler än :max objekt.',
    'file' => ':attribute får inte vara större än :max kilobyte.',
    'numeric' => ':attribute får inte vara större än :max.',
    'string' => ':attribute får inte vara längre än :max tecken.',
],
'max_digits' => ':attribute får inte ha fler än :max siffror.',
'mimes' => ':attribute måste vara en fil av typen: :values.',
'mimetypes' => ':attribute måste vara en fil av typen: :values.',
'min' => [
    'array' => ':attribute måste ha minst :min objekt.',
    'file' => ':attribute måste vara minst :min kilobyte.',
    'numeric' => ':attribute måste vara minst :min.',
    'string' => ':attribute måste vara minst :min tecken.',
],
'min_digits' => ':attribute måste ha minst :min siffror.',
'missing' => ':attribute måste saknas.',
'missing_if' => ':attribute måste saknas när :other är :value.',
'missing_unless' => ':attribute måste saknas om inte :other är :value.',
'missing_with' => ':attribute måste saknas när :values är närvarande.',
'missing_with_all' => ':attribute måste saknas när :values är närvarande.',
'multiple_of' => ':attribute måste vara en multipel av :value.',
'not_in' => 'Den valda :attribute är ogiltig.',
'not_regex' => ':attribute format är ogiltigt.',
'numeric' => ':attribute måste vara ett nummer.',
'password' => [
    'letters' => ':attribute måste innehålla minst en bokstav.',
    'mixed' => ':attribute måste innehålla minst en versal och en gemen bokstav.',
    'numbers' => ':attribute måste innehålla minst en siffra.',
    'symbols' => ':attribute måste innehålla minst en symbol.',
    'uncompromised' => 'Den angivna :attribute har förekommit i en dataläcka. Välj ett annat :attribute.',
],
'present' => ':attribute måste vara närvarande.',
'present_if' => ':attribute måste vara närvarande när :other är :value.',
'present_unless' => ':attribute måste vara närvarande om inte :other är :value.',
'present_with' => ':attribute måste vara närvarande när :values är närvarande.',
'present_with_all' => ':attribute måste vara närvarande när :values är närvarande.',
'prohibited' => ':attribute är förbjudet.',
'prohibited_if' => ':attribute är förbjudet när :other är :value.',
'prohibited_unless' => ':attribute är förbjudet om inte :other är i :values.',
'prohibits' => ':attribute förbjuder :other från att vara närvarande.',
'regex' => ':attribute format är ogiltigt.',
'required' => ':attribute är obligatoriskt.',
'required_array_keys' => ':attribute måste innehålla poster för: :values.',
'required_if' => ':attribute är obligatoriskt när :other är :value.',
'required_if_accepted' => ':attribute är obligatoriskt när :other är accepterat.',
'required_if_declined' => ':attribute är obligatoriskt när :other är avböjt.',
'required_unless' => ':attribute är obligatoriskt om inte :other är i :values.',
'required_with' => ':attribute är obligatoriskt när :values är närvarande.',
'required_with_all' => ':attribute är obligatoriskt när :values är närvarande.',
'required_without' => ':attribute är obligatoriskt när :values inte är närvarande.',
'required_without_all' => ':attribute är obligatoriskt när inget av :values är närvarande.',
'same' => ':attribute och :other måste matcha.',
'size' => [
    'array' => ':attribute måste innehålla :size objekt.',
    'file' => ':attribute måste vara :size kilobyte.',
    'numeric' => ':attribute måste vara :size.',
    'string' => ':attribute måste vara :size tecken.',
],
'starts_with' => ':attribute måste börja med ett av följande: :values.',
'string' => ':attribute måste vara en sträng.',
'timezone' => ':attribute måste vara en giltig tidszon.',
'unique' => ':attribute är redan upptaget.',
'uploaded' => ':attribute misslyckades med att laddas upp.',
'uppercase' => ':attribute måste vara med stora bokstäver.',
'url' => ':attribute måste vara en giltig URL.',
'uuid' => ':attribute måste vara ett giltigt UUID.',

/*
|--------------------------------------------------------------------------
| Custom Validation Language Lines
|--------------------------------------------------------------------------
|
| Here you may specify custom validation messages for attributes using the
| convention "attribute.rule" to name the lines. This makes it quick to
| specify a specific custom language line for a given attribute rule.
|
*/

'custom' => [
    'attribute-name' => [
        'rule-name' => 'anpassat-meddelande',
    ],
],

/*
|--------------------------------------------------------------------------
| Custom Validation Attributes
|--------------------------------------------------------------------------
|
| The following language lines are used to swap attribute place-holders
| with something more reader-friendly such as "E-Mail Address" instead
| of "email". This simply helps us make messages a little cleaner.
|
*/

'attributes' => [],

];
