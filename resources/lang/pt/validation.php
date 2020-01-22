<?php 

return [
    'accepted' => 'O campo :attribute deverá ser aceite.',
    'active_url' => 'O campo :attribute não contém um URL válido.',
    'after' => 'O campo :attribute deverá conter uma data posterior a :date.',
    'after_or_equal' => 'O campo :attribute deverá conter uma data posterior ou igual a :date.',
    'alpha' => 'O campo :attribute deverá conter apenas letras.',
    'alpha_dash' => 'O campo :attribute deverá conter apenas letras, números e traços.',
    'alpha_num' => 'O campo :attribute deverá conter apenas letras e números .',
    'array' => 'O campo :attribute deverá conter uma coleção de elementos.',
    'before' => 'O campo :attribute deverá conter uma data anterior a :date.',
    'before_or_equal' => 'O Campo :attribute deverá conter uma data anterior ou igual a :date.',
    'between' => [
        'numeric' => 'O campo :attribute deverá ter um valor entre :min - :max.',
        'file' => 'O campo :attribute deverá ter um tamanho entre :min - :max kilobytes.',
        'string' => 'O campo :attribute deverá conter entre :min - :max caracteres.',
        'array' => 'O campo :attribute deverá conter entre :min - :max elementos.',
    ],
    'boolean' => 'O campo :attribute deverá conter o valor verdadeiro ou falso.',
    'confirmed' => 'Nova senha e senha de confirmação não coincidem.',
    'date' => 'O campo :attribute não contém uma data válida.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'A data indicada para o campo :attribute não respeita o formato :format.',
    'different' => 'Os campos :attribute e :other deverão conter valores diferentes.',
    'digits' => 'O campo :attribute deverá conter :digits caracteres.',
    'digits_between' => 'O campo :attribute deverá conter entre :min a :max caracteres.',
    'dimensions' => 'O campo :attribute deverá conter uma dimensão de imagem válida.',
    'distinct' => 'O campo :attribute contém um valor duplicado.',
    'email' => 'O e-mail não é válido.',
    // 'email' => 'O campo :attribute não contém um endereço de correio eletrónico válido.',
    'exists' => 'O valor selecionado para o campo :attribute é inválido.',
    'file' => 'O campo :attribute deverá conter um ficheiro.',
    'filled' => 'É obrigatória a indicação de um valor para o campo :attribute.',
    'image' => 'O campo :attribute deverá conter uma imagem.',
    'in' => 'O campo :attribute não contém um valor válido.',
    'in_array' => 'O campo :attribute não existe em :other.',
    'integer' => 'O campo :attribute deverá conter um número inteiro.',
    'ip' => 'O campo :attribute deverá conter um IP válido.',
    'ipv4' => 'O campo :attribute deverá conter um IPv4 válido.',
    'ipv6' => 'O campo :attribute deverá conter um IPv6 válido.',
    'json' => 'O campo :attribute deverá conter um texto JSON válido.',
    'max' => [
        'numeric' => 'O campo :attribute não deverá conter um valor superior a :max.',
        'file' => 'O campo :attribute não deverá ter um tamanho superior a :max kilobytes.',
        'string' => 'O campo :attribute não deverá conter mais de :max caracteres.',
        'array' => 'O campo :attribute não deverá conter mais de :max elementos.',
    ],
    'mimes' => 'O campo :attribute deverá conter um ficheiro do tipo: :values.',
    'mimetypes' => 'O campo :attribute deverá conter um ficheiro do tipo: :values.',
    'min' => [
        'numeric' => 'O campo :attribute deverá ter um valor superior ou igual a :min.',
        'file' => 'O campo :attribute deverá ter no mínimo :min kilobytes.',
        'string' => ':attribute deve ter pelo menos :min caracteres.',
        'array' => 'O campo :attribute deverá conter no mínimo :min elementos.',
    ],
    'not_in' => 'O campo :attribute contém um valor inválido.',
    'numeric' => 'O campo :attribute deverá conter um valor numérico.',
    'present' => 'O campo :attribute deverá estar presente.',
    'regex' => 'O formato do valor para o campo :attribute é inválido.',
    'required' => 'O campo ":attribute" é obrigatório',
    'required_if' => 'É obrigatória a indicação de um valor para o campo :attribute quando o valor do campo :other é igual a :value.',
    'required_unless' => 'É obrigatória a indicação de um valor para o campo :attribute a menos que :other esteja presente em :values.',
    'required_with' => 'É obrigatória a indicação de um valor para o campo :attribute quando :values está presente.',
    'required_with_all' => 'É obrigatória a indicação de um valor para o campo :attribute quando um dos :values está presente.',
    // 'required_without' => 'É obrigatória a indicação de um valor para o campo :attribute quando :values não está presente.',
    'required_without' => 'O campo ":attribute" é obrigatório', 
    'required_without_all' => 'É obrigatória a indicação de um valor para o campo :attribute quando nenhum dos :values está presente.',
    'same' => 'Os campos :attribute e :other deverão conter valores iguais.',
    'size' => [
        'numeric' => 'O campo :attribute deverá conter o valor :size.',
        'file' => 'O campo :attribute deverá ter o tamanho de :size kilobytes.',
        'string' => 'O campo :attribute deverá conter :size caracteres.',
        'array' => 'O campo :attribute deverá conter :size elementos.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'O campo :attribute deverá conter texto.',
    'timezone' => 'O campo :attribute deverá ter um fuso horário válido.',
    'unique' => 'O valor indicado para o campo :attribute já se encontra registado.',
    'uploaded' => 'O upload do ficheiro :attribute falhou.',
    'url' => 'O formato do URL indicado para o campo :attribute é inválido.',
    'required_package_id' => 'You have to select a premium ad option to continue.',
    'required_payment_method_id' => 'You have to select a payment method to continue.',
    'blacklist_email_rule' => 'This email address is blacklisted.',
    'blacklist_domain_rule' => 'The domain of your email address is blacklisted.',
    'blacklist_word_rule' => 'The :attribute contains a banned words or phrases.',
    'blacklist_title_rule' => 'The :attribute contains a banned words or phrases.',
    'between_rule' => 'The :attribute must be between :min and :max characters.pt',
    'recaptcha' => 'The :attribute field is not correct.',
    // 'phone' => 'The :attribute field contains an invalid number.',
    'phone' => 'O campo :attribute contém um número inválido',
    'dumbpwd' => 'This password is just too common. Please try another!',
    'phone_number' => 'Your phone number is not valid.',
    'username_is_valid_rule' => 'The :attribute field must be an alphanumeric string.',
    'username_is_allowed_rule' => 'The :attribute is not allowed.',
    'custom' => [
        'mysql_connection' => [
            'required' => 'Can\'t connect to MySQL server',
        ],
        'database_not_empty' => [
            'required' => 'The database is not empty',
        ],
        'promo_code_not_valid' => [
            'required' => 'The promo code is not valid',
        ],
        'smtp_valid' => [
            'required' => 'Can\'t connect to SMTP server',
        ],
        'yaml_parse_error' => [
            'required' => 'Can\'t parse yaml. Please check the syntax',
        ],
        'file_not_found' => [
            'required' => 'File not found.',
        ],
        'not_zip_archive' => [
            'required' => 'The file is not a zip package.',
        ],
        'zip_archive_unvalid' => [
            'required' => 'Cannot read the package.',
        ],
        'custom_criteria_empty' => [
            'required' => 'Custom criteria cannot be empty',
        ],
        'php_bin_path_invalid' => [
            'required' => 'Invalid PHP executable. Please check again.',
        ],
        'can_not_empty_database' => [
            'required' => 'Cannot DROP certain tables, please cleanup your database manually and try again.',
        ],
        'recaptcha_invalid' => [
            'required' => 'Invalid reCAPTCHA check.',
        ],
        'payment_method_not_valid' => [
            'required' => 'Something went wrong with payment method setting. Please check again.',
        ],
    ],
    'attributes' => [
        'gender' => 'gender',
        'name' => 'name',
        'first_name' => 'Nome',
        'last_name' => 'last name',
        'user_type' => 'user type',
        'country' => 'country',
        'phone' => 'Telefone',
        'address' => 'address',
        'mobile' => 'mobile',
        'sex' => 'sex',
        'year' => 'year',
        'month' => 'month',
        'day' => 'day',
        'hour' => 'hour',
        'minute' => 'minute',
        'second' => 'second',
        'username' => 'username',
        'email' => 'E-mail',
        'password' => 'Senha',
        'password_confirmation' => 'password confirmation',
        'g-recaptcha-response' => 'captcha',
        'term' => 'terms',
        'category' => 'category',
        'post_type' => 'post type',
        'title' => 'title',
        'body' => 'body',
        'description' => 'description',
        'excerpt' => 'excerpt',
        'date' => 'date',
        'time' => 'time',
        'available' => 'available',
        'size' => 'size',
        'price' => 'price',
        'salary' => 'salary',
        'contact_name' => 'name',
        'location' => 'location',
        'admin_code' => 'location',
        'city' => 'city',
        'package' => 'package',
        'payment_method' => 'payment method',
        'sender_name' => 'name',
        'subject' => 'subject',
        'message' => 'Mensagem',
        'report_type' => 'Rasão',
        'report_type_id' => 'Rasão',
        'file' => 'file',
        'filename' => 'filename',
        'picture' => 'picture',
        'resume' => 'resume',
        'login' => 'login',
        'code' => 'code',
        'token' => 'token',
        'comment' => 'comment',
        'rating' => 'rating',
    ],
    'not_regex' => 'The :attribute format is invalid.',
    'custom.database_connection.required' => 'Can\'t connect to MySQL server',
    'attributes.gender_id' => 'gender',
    'attributes.user_type_id' => 'user type',
    'attributes.country_code' => 'country',
    'attributes.category_id' => 'category',
    'attributes.post_type_id' => 'post type',
    'attributes.city_id' => 'city',
    'attributes.package_id' => 'package',
    'attributes.payment_method_id' => 'payment method',
    'attributes.report_type_id' => 'report type',
    'locale_of_language_rule' => 'The :attribute field is not valid.',
    'locale_of_country_rule' => 'The :attribute field is not valid.',
    'currencies_codes_are_valid_rule' => 'The :attribute field is not valid.',
    'attributes.locale' => 'locale',
    'attributes.currencies' => 'currencies',
    'blacklist_ip_rule' => 'The :attribute must be a valid IP address.',
    'custom_field_unique_rule' => 'The :field_1 have this :field_2 assigned already.',
    'custom_field_unique_rule_field' => 'The :field_1 is already assigned to this :field_2.',
    'custom_field_unique_children_rule' => 'A child :field_1 of the :field_1 have this :field_2 assigned already.',
    'custom_field_unique_children_rule_field' => 'The :field_1 is already assign to one :field_2 of this :field_2.',
    'custom_field_unique_parent_rule' => 'The parent :field_1 of the :field_1 have this :field_2 assigned already.',
    'custom_field_unique_parent_rule_field' => 'The :field_1 is already assign to the parent :field_2 of this :field_2.',
];
