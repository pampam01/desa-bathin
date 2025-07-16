# 🤝 Contributing to Portal Parakan

Terima kasih atas minat Anda untuk berkontribusi pada Portal Parakan! Panduan ini akan membantu Anda memulai kontribusi.

## 📋 Table of Contents

- [Code of Conduct](#code-of-conduct)
- [How to Contribute](#how-to-contribute)
- [Development Setup](#development-setup)
- [Coding Standards](#coding-standards)
- [Pull Request Process](#pull-request-process)
- [Issue Reporting](#issue-reporting)
- [Development Guidelines](#development-guidelines)

## 📜 Code of Conduct

Proyek ini mengikuti [Contributor Covenant Code of Conduct](https://www.contributor-covenant.org/). Dengan berpartisipasi, Anda diharapkan mematuhi kode etik ini.

### Our Pledge

- Menciptakan lingkungan yang welcome dan inklusif
- Menghormati pendapat dan pengalaman yang berbeda
- Memberikan feedback yang konstruktif
- Fokus pada yang terbaik untuk komunitas

## 🚀 How to Contribute

### 1. Fork the Repository

```bash
# Fork repository di GitHub
# Clone your fork
git clone https://github.com/your-username/portal-parakan.git
cd portal-parakan

# Add upstream remote
git remote add upstream https://github.com/original-owner/portal-parakan.git
```

### 2. Create a Branch

```bash
# Create and switch to new branch
git checkout -b feature/your-feature-name

# Or for bug fixes
git checkout -b fix/bug-description
```

### 3. Make Changes

- Ikuti coding standards yang telah ditetapkan
- Tulis tests untuk fitur baru
- Update dokumentasi jika diperlukan
- Commit changes dengan pesan yang jelas

### 4. Test Your Changes

```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=YourTestClass

# Check code style
./vendor/bin/phpcs
```

### 5. Submit Pull Request

```bash
# Push your branch
git push origin feature/your-feature-name

# Create pull request di GitHub
```

## 🛠️ Development Setup

### Prerequisites

- PHP 8.2+
- Composer 2.0+
- Node.js 16+
- MySQL 8.0+
- Git

### Local Development

1. **Clone and Install**
   ```bash
   git clone https://github.com/your-username/portal-parakan.git
   cd portal-parakan
   composer install
   npm install
   ```

2. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

4. **Run Development Server**
   ```bash
   php artisan serve
   npm run dev
   ```

### Development Tools

- **IDE**: PhpStorm, VS Code, atau Sublime Text
- **Database**: MySQL Workbench, phpMyAdmin, atau TablePlus
- **API Testing**: Postman, Insomnia, atau curl
- **Browser**: Chrome DevTools untuk debugging

## 📝 Coding Standards

### PHP Coding Standards

Ikuti [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard:

```php
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $users = User::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return response()->view('users.index', compact('users'));
    }
}
```

### JavaScript Standards

```javascript
// Use ES6+ features
const fetchUsers = async (searchTerm = '') => {
    try {
        const response = await fetch(`/api/users?search=${searchTerm}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching users:', error);
        throw error;
    }
};

// Use consistent naming
const handleUserSubmit = (event) => {
    event.preventDefault();
    // Handle form submission
};
```

### Blade Templates

```blade
{{-- Use proper indentation --}}
<div class="card">
    <div class="card-header">
        <h5 class="card-title">{{ $title }}</h5>
    </div>
    <div class="card-body">
        @if($users->count() > 0)
            @foreach($users as $user)
                <div class="user-item">
                    <h6>{{ $user->name }}</h6>
                    <p>{{ $user->email }}</p>
                </div>
            @endforeach
        @else
            <p class="text-muted">No users found.</p>
        @endif
    </div>
</div>
```

### CSS Standards

```css
/* Use BEM methodology */
.user-card {
    display: flex;
    flex-direction: column;
    padding: 1rem;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
}

.user-card__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.user-card__title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
}

.user-card--featured {
    border-color: #007bff;
    background-color: #f8f9fa;
}
```

## 🔄 Pull Request Process

### Before Submitting

1. **Update your fork**
   ```bash
   git fetch upstream
   git checkout main
   git merge upstream/main
   ```

2. **Test your changes**
   ```bash
   php artisan test
   npm run test
   ```

3. **Code quality check**
   ```bash
   ./vendor/bin/phpcs
   ./vendor/bin/phpstan analyse
   ```

### PR Guidelines

1. **Title**: Use clear, descriptive titles
   - ✅ "Add user avatar upload functionality"
   - ❌ "Fix stuff"

2. **Description**: Provide detailed information
   ```markdown
   ## Changes Made
   - Added avatar upload for user profiles
   - Implemented image validation and resize
   - Updated user model and migration
   
   ## Testing
   - [x] Unit tests pass
   - [x] Feature tests pass
   - [x] Manual testing completed
   
   ## Screenshots
   [Include relevant screenshots]
   
   ## Breaking Changes
   None
   
   ## Additional Notes
   This feature requires storage:link to be run
   ```

3. **Link Issues**: Reference related issues
   ```markdown
   Closes #123
   Relates to #456
   ```

### Review Process

1. **Automated checks** must pass
2. **Code review** by maintainers
3. **Testing** in staging environment
4. **Approval** from project maintainers
5. **Merge** into main branch

## 🐛 Issue Reporting

### Bug Reports

Use the bug report template:

```markdown
**Bug Description**
A clear description of the bug.

**Steps to Reproduce**
1. Go to '...'
2. Click on '....'
3. See error

**Expected Behavior**
What should happen.

**Actual Behavior**
What actually happens.

**Screenshots**
If applicable, add screenshots.

**Environment**
- OS: [e.g. Windows 10]
- Browser: [e.g. Chrome 90]
- PHP Version: [e.g. 8.2]
- Laravel Version: [e.g. 11.0]

**Additional Context**
Any other relevant information.
```

### Feature Requests

```markdown
**Feature Description**
A clear description of the feature.

**Use Case**
Why is this feature needed?

**Proposed Solution**
Your suggested implementation.

**Alternatives**
Alternative solutions considered.

**Additional Context**
Any other relevant information.
```

## 🔧 Development Guidelines

### Database Migrations

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
            
            $table->index(['user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
```

### Model Relationships

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }
}
```

### API Resources

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'avatar' => $this->avatar ? asset('storage/' . $this->avatar) : null,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
        ];
    }
}
```

### Testing

```php
<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_profile(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('users.show', $user));

        $response->assertStatus(200);
        $response->assertViewHas('user', $user);
    }

    public function test_user_can_update_profile(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->put(route('users.update', $user), [
                'name' => 'Updated Name',
                'email' => 'updated@example.com',
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }
}
```

## 📚 Documentation

### Code Documentation

```php
/**
 * Update the specified user in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\User  $user
 * @return \Illuminate\Http\RedirectResponse
 * 
 * @throws \Illuminate\Validation\ValidationException
 */
public function update(Request $request, User $user): RedirectResponse
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update($validated);

    return redirect()->route('users.show', $user)
        ->with('success', 'User updated successfully.');
}
```

### API Documentation

```php
/**
 * @OA\Get(
 *     path="/api/users",
 *     summary="Get list of users",
 *     tags={"Users"},
 *     @OA\Parameter(
 *         name="search",
 *         in="query",
 *         description="Search term",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of users",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/User"))
 *         )
 *     )
 * )
 */
```

## 🎯 Areas for Contribution

### High Priority
- [ ] Mobile app API endpoints
- [ ] Email notification system
- [ ] Advanced search functionality
- [ ] Performance optimization
- [ ] Security enhancements

### Medium Priority
- [ ] Multi-language support
- [ ] Advanced analytics
- [ ] Export functionality
- [ ] Comment system
- [ ] File management

### Low Priority
- [ ] Dark mode theme
- [ ] Social media integration
- [ ] PWA support
- [ ] Real-time notifications
- [ ] Advanced user roles

## 🏆 Recognition

Contributors akan diakui dalam:
- README.md contributors section
- CHANGELOG.md for significant contributions
- GitHub contributors page
- Project documentation

## 📞 Getting Help

- **Discord**: [Portal Parakan Discord](https://discord.gg/portal-parakan)
- **Email**: dev@parakan.desa.id
- **GitHub Discussions**: [Portal Parakan Discussions](https://github.com/your-username/portal-parakan/discussions)

## 📄 License

By contributing to Portal Parakan, you agree that your contributions will be licensed under the MIT License.

---

**Happy Contributing!** 🎉
