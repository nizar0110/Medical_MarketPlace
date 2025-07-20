<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ChatbotController extends Controller
{
    /**
     * Traiter les messages du chatbot
     */
    public function chat(Request $request)
    {
        $message = strtolower(trim($request->input('message', '')));
        
        // Réponses prédéfinies
        $responses = [
            'bonjour' => 'Bonjour ! Je suis l\'assistant virtuel de Medical Marketplace. Comment puis-je vous aider ?',
            'hello' => 'Hello ! Je suis là pour vous aider avec vos questions sur nos produits médicaux.',
            'aide' => 'Je peux vous aider à :<br>• Trouver des produits<br>• Expliquer les catégories<br>• Donner des informations sur la livraison<br>• Vous guider pour passer une commande',
            'produits' => 'Nous avons plusieurs catégories de produits :<br>• Équipements de diagnostic<br>• Instruments chirurgicaux<br>• Mobilier médical<br>• Consommables<br>• Technologies médicales<br><br>Que recherchez-vous spécifiquement ?',
            'prix' => 'Nos prix varient selon les produits et sont affichés en Dirhams (DH). Vous pouvez voir tous nos prix sur la page des produits. Souhaitez-vous que je vous aide à trouver un produit spécifique ?',
            'livraison' => 'Livraison gratuite pour les commandes supérieures à 1000 DH. Sinon, frais de livraison de 99.99 DH. Délai de livraison : 2-5 jours ouvrés.',
            'commande' => 'Pour passer une commande :<br>1. Ajoutez vos produits au panier<br>2. Allez dans votre panier<br>3. Cliquez sur "Passer la commande"<br>4. Suivez les étapes de paiement',
            'contact' => 'Vous pouvez nous contacter par email à support@medical.com ou par téléphone au 01 23 45 67 89.',
            'merci' => 'De rien ! N\'hésitez pas si vous avez d\'autres questions.',
            'au revoir' => 'Au revoir ! N\'hésitez pas à revenir si vous avez besoin d\'aide.',
            'bye' => 'À bientôt ! Bonne journée !'
        ];

        // Recherche de produits
        if (strpos($message, 'recherche') !== false || strpos($message, 'trouver') !== false) {
            $searchTerm = str_replace(['recherche', 'trouver', 'cherche'], '', $message);
            $searchTerm = trim($searchTerm);
            
            if (!empty($searchTerm)) {
                $products = Product::where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%')
                    ->take(3)
                    ->get();
                
                if ($products->count() > 0) {
                    $response = "J'ai trouvé " . $products->count() . " produit(s) correspondant à '$searchTerm' :<br><br>";
                    foreach ($products as $product) {
                        $response .= "• <strong>{$product->name}</strong> - {$product->price} DH<br>";
                    }
                    $response .= "<br><a href='/products' class='text-blue-600 hover:underline'>Voir tous les produits</a>";
                } else {
                    $response = "Désolé, je n'ai trouvé aucun produit correspondant à '$searchTerm'. Essayez avec d'autres mots-clés ou consultez notre catalogue complet.";
                }
            } else {
                $response = "Que souhaitez-vous rechercher ? Décrivez le produit que vous cherchez.";
            }
        }
        // Catégories
        elseif (strpos($message, 'catégorie') !== false || strpos($message, 'catégories') !== false) {
            $categories = Category::all();
            $response = "Voici nos catégories de produits :<br><br>";
            foreach ($categories as $category) {
                $response .= "• <strong>{$category->name}</strong><br>";
            }
            $response .= "<br>Quelle catégorie vous intéresse ?";
        }
        // Stock
        elseif (strpos($message, 'stock') !== false || strpos($message, 'disponible') !== false) {
            $response = "Pour vérifier la disponibilité d'un produit, allez sur la page du produit. Le stock est indiqué en temps réel. Si un produit n'est pas en stock, il sera marqué 'Rupture de stock'.";
        }
        // Paiement
        elseif (strpos($message, 'paiement') !== false || strpos($message, 'payer') !== false) {
            $response = "Nous acceptons les cartes bancaires (Visa, Mastercard), PayPal et les virements bancaires. Tous les paiements sont sécurisés et cryptés.";
        }
        // Retour
        elseif (strpos($message, 'retour') !== false || strpos($message, 'remboursement') !== false) {
            $response = "Vous avez 14 jours pour retourner un produit non utilisé dans son emballage d'origine. Les frais de retour sont à votre charge sauf en cas de produit défectueux.";
        }
        // Réponses par défaut
        else {
            $response = $responses[$message] ?? "Je ne comprends pas votre demande. Pouvez-vous reformuler ? Voici ce que je peux faire :<br>• Vous aider à trouver des produits<br>• Expliquer nos services<br>• Donner des informations sur la livraison et les paiements<br>• Vous guider pour passer une commande";
        }

        return response()->json([
            'response' => $response,
            'timestamp' => now()->format('H:i')
        ]);
    }

    /**
     * Afficher la page du chatbot
     */
    public function index()
    {
        return view('chatbot.index');
    }
}
