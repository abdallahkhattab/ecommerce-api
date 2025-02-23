<?

use App\Repositories\Cart\CartRepositary;
use App\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{

    public function register(){
        $this->app->bind(CartRepositoryInterface::class,CartRepositary::class);
    }
}