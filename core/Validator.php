<?php
namespace Core;
use ORM;
class Validator {
    protected $errors = [];

    /**
     * Valida i dati in base alle regole specificate
     */
    public function validate($data, $rules) {
        foreach ($rules as $field => $ruleSet) {
            $rulesArray = explode('|', $ruleSet);
            foreach ($rulesArray as $rule) {
                if (strpos($rule, ':') !== false) {
                    [$ruleName, $param] = explode(':', $rule);
                } else {
                    $ruleName = $rule;
                    $param = null;
                }

                if (method_exists($this, $ruleName)) {
                    $this->$ruleName($field, $data[$field] ?? null, $param);
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * Verifica se un campo è obbligatorio
     */
    protected function required($field, $value, $param) {
        if (empty($value)) {
            $this->errors[$field][] = "Il campo $field è obbligatorio.";
        }
    }

    /**
     * Verifica se il valore ha una lunghezza minima
     */
    protected function min($field, $value, $param) {
        $value = (string) $value; // 🔥 Convertiamo il valore in stringa
        if (strlen($value) < $param) {
            $this->errors[$field][] = "Il campo $field deve contenere almeno $param caratteri.";
        }
    }
    
    protected function max($field, $value, $param) {
        $value = (string) $value; // 🔥 Convertiamo il valore in stringa
        if (strlen($value) > $param) {
            $this->errors[$field][] = "Il campo $field non può superare $param caratteri.";
        }
    }
    
    /**
     * Verifica se il valore è un'email valida
     */
    protected function email($field, $value, $param) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "Il campo $field deve essere un'email valida.";
        }
    }

    /**
     * Ottiene gli errori di validazione
     */
    public function errors() {
        return $this->errors;
    }


    protected function unique($field, $value, $param) {
        $exists = ORM::for_table($param)->where($field, $value)->find_one();
        if ($exists) {
            $this->errors[$field][] = "Il valore di $field è già in uso.";
        }
    }
}
