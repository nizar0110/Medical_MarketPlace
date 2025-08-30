<?php

namespace App\Helpers;

class MarocHelper
{
    /**
     * Formater un montant en format marocain (DH)
     */
    public static function formatCurrency($amount, $decimals = 2): string
    {
        return number_format($amount, $decimals, ',', ' ') . ' DH';
    }

    /**
     * Formater une date en format marocain
     */
    public static function formatDate($date, $format = 'd/m/Y'): string
    {
        if (is_string($date)) {
            $date = new \DateTime($date);
        }
        return $date->format($format);
    }

    /**
     * Formater un numéro de téléphone marocain
     */
    public static function formatPhone($phone): string
    {
        // Supprimer tous les caractères non numériques
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Vérifier si c'est un numéro marocain
        if (strlen($phone) === 10 && substr($phone, 0, 2) === '06') {
            return '+212 ' . substr($phone, 1, 2) . ' ' . substr($phone, 3, 2) . ' ' . substr($phone, 5, 2) . ' ' . substr($phone, 7, 2);
        }
        
        if (strlen($phone) === 10 && substr($phone, 0, 2) === '05') {
            return '+212 ' . substr($phone, 0, 2) . ' ' . substr($phone, 2, 2) . ' ' . substr($phone, 4, 2) . ' ' . substr($phone, 6, 2);
        }
        
        return $phone;
    }

    /**
     * Calculer la TVA marocaine (20%)
     */
    public static function calculateTVA($amount, $rate = 20.0): array
    {
        $tvaAmount = $amount * ($rate / 100);
        $totalWithTVA = $amount + $tvaAmount;
        
        return [
            'ht' => $amount,
            'tva_rate' => $rate,
            'tva_amount' => $tvaAmount,
            'ttc' => $totalWithTVA,
        ];
    }

    /**
     * Formater un numéro de facture marocain
     */
    public static function formatInvoiceNumber($number, $prefix = 'FACT'): string
    {
        $year = date('Y');
        return sprintf('%s-%s-%06d', $prefix, $year, $number);
    }

    /**
     * Formater un numéro de devis marocain
     */
    public static function formatQuoteNumber($number, $prefix = 'DEV'): string
    {
        $year = date('Y');
        return sprintf('%s-%s-%06d', $prefix, $year, $number);
    }

    /**
     * Obtenir les informations de l'entreprise marocaine
     */
    public static function getCompanyInfo(): array
    {
        return config('maroc.company');
    }

    /**
     * Obtenir les informations fiscales marocaines
     */
    public static function getFiscalInfo(): array
    {
        return config('maroc.fiscal');
    }

    /**
     * Obtenir les régions marocaines
     */
    public static function getRegions(): array
    {
        return config('maroc.regions');
    }

    /**
     * Formater une adresse marocaine
     */
    public static function formatAddress($street, $city, $postalCode, $country = 'Maroc'): string
    {
        return sprintf('%s, %s %s, %s', $street, $postalCode, $city, $country);
    }

    /**
     * Vérifier si un code postal est valide pour le Maroc
     */
    public static function isValidPostalCode($postalCode): bool
    {
        // Les codes postaux marocains sont à 5 chiffres
        return preg_match('/^\d{5}$/', $postalCode);
    }

    /**
     * Obtenir le fuseau horaire marocain
     */
    public static function getTimezone(): string
    {
        return config('maroc.business_hours.timezone', 'Africa/Casablanca');
    }

    /**
     * Formater un IBAN marocain
     */
    public static function formatIBAN($iban): string
    {
        // Formater l'IBAN marocain avec des espaces tous les 4 caractères
        $iban = str_replace(' ', '', $iban);
        return wordwrap($iban, 4, ' ', true);
    }
}
