namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Requests\RestaurantRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::where('is_approved', true)
            ->with('certifications')
            ->paginate(10);
            
        return view('user.search', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurant.profile');
    }

    public function store(RestaurantRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        
        $restaurant = Restaurant::create($data);
        
        return redirect()->route('restaurant.dashboard')
            ->with('success', 'Restaurant profile created successfully!');
    }

    public function show(Restaurant $restaurant)
    {
        return view('user.restaurant-detail', compact('restaurant'));
    }

    public function edit(Restaurant $restaurant)
    {
        $this->authorize('update', $restaurant);
        return view('restaurant.profile', compact('restaurant'));
    }

    public function update(RestaurantRequest $request, Restaurant $restaurant)
    {
        $this->authorize('update', $restaurant);
        
        $restaurant->update($request->validated());
        
        return redirect()->route('restaurant.dashboard')
            ->with('success', 'Restaurant profile updated successfully!');
    }
}