namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use MongoDB\Driver\Exception\BulkWriteException;

class HandleSessionDuplicateKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (BulkWriteException $e) {
            if ($e->getCode() === 11000) {
                // Handle duplicate session key error
                // You can regenerate the session ID or any other handling logic
                Session::regenerate();
                return $next($request);
            }

            throw $e;
        }
    }
}
