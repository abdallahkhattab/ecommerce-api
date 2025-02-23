<?

use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{

    public function register(){
        $this->app->bind(CartRepositoryInterface::class,CartRepository::class);
    }
}