# 🗳️ Livewire Poll Application

A modern, real-time polling application built with **Laravel Livewire 3** that demonstrates advanced Livewire concepts including real-time validation, dynamic form handling, and component communication.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)
![Livewire](https://img.shields.io/badge/Livewire-3.x-orange.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![Tailwind](https://img.shields.io/badge/Tailwind-CSS-38B2AC.svg)

## ✨ Features

### 🚀 Core Functionality
- **Real-time Poll Creation** - Create polls with dynamic options
- **Live Validation** - Instant feedback as users type
- **Interactive Poll Display** - View all polls with vote counts
- **Dynamic Options Management** - Add/remove poll options on the fly
- **Automatic Refresh** - Polls list updates automatically when new polls are created

### 🎯 Livewire Features Demonstrated
- **Real-time Validation** with `wire:model.live`
- **Dynamic Property Binding** for arrays
- **Event Dispatching & Listening** for component communication
- **Live Validation** using `validateOnly()` method
- **Component Lifecycle** management
- **Flash Messages** for user feedback

## 🏗️ Project Structure

```
livewire-poll/
├── app/
│   ├── Livewire/
│   │   ├── CreatePoll.php      # Poll creation component
│   │   └── Polls.php           # Poll display component
│   └── Models/
│       ├── Poll.php            # Poll model
│       ├── Option.php          # Option model
│       └── Vote.php            # Vote model
├── resources/
│   └── views/
│       ├── app.blade.php       # Main layout
│       └── livewire/
│           ├── create-poll.blade.php
│           └── polls.blade.php
└── database/
    └── migrations/            # Database schema
```

## 🛠️ Installation

### Prerequisites
- PHP 8.2+
- Composer
- MySQL/PostgreSQL
- Node.js (for Tailwind CSS)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/Ahmed-Aladdin-Khidr/Laravel-livewire-poll.git
   cd Laravel-livewire-poll
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   ```bash
   # Update .env with your database credentials
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=livewire_poll
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

7. **Visit the application**
   ```
   http://127.0.0.1:8000
   ```

## 🎨 Usage

### Creating a Poll
1. **Enter Poll Title** - Minimum 3 characters with real-time validation
2. **Add Options** - Click "Add Option" to create multiple choices
3. **Remove Options** - Click "Remove" to delete unwanted options
4. **Submit** - Click "Create Poll" to save your poll

### Viewing Polls
- All created polls appear in the "Available Polls" section
- Each poll shows its title and all available options
- Vote counts are displayed for each option
- New polls appear automatically without page refresh

## 🔧 Technical Implementation

### Livewire Components

#### CreatePoll Component
```php
class CreatePoll extends Component
{
    public $title;
    public $options = ['First Option'];
    
    protected $rules = [
        'title' => 'required|string|min:3|max:255',
        'options' => 'required|array|min:1|max:10',
        'options.*' => 'required|string|min:3|max:255',
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
```

#### Polls Component
```php
class Polls extends Component
{
    protected $listeners = ['poll-created' => '$refresh'];
    
    public function render()
    {
        $polls = Poll::with('options.votes')->latest()->get();
        return view('livewire.polls', ['polls' => $polls]);
    }
}
```

### Database Schema

#### Polls Table
```sql
- id (primary key)
- title (string)
- created_at
- updated_at
```

#### Options Table
```sql
- id (primary key)
- poll_id (foreign key)
- name (string)
- created_at
- updated_at
```

#### Votes Table
```sql
- id (primary key)
- option_id (foreign key)
- created_at
- updated_at
```

### Key Livewire Concepts

#### Real-time Validation
```blade
<input type="text" wire:model.live="title" />
@error('title')
    <div class="error">{{ $message }}</div>
@enderror
```

#### Dynamic Array Handling
```blade
@foreach ($options as $index => $option)
    <input type="text" wire:model.live="options.{{ $index }}" />
@endforeach
```

#### Event Communication
```php
// Dispatch event
$this->dispatch('poll-created');

// Listen for event
protected $listeners = ['poll-created' => '$refresh'];
```

## 🎯 Livewire Features Demonstrated

### 1. **Real-time Validation**
- Instant validation feedback as users type
- Custom validation messages
- Field-specific validation using `validateOnly()`

### 2. **Dynamic Form Handling**
- Dynamic option addition/removal
- Array property binding with `wire:model.live`
- Automatic form reset after submission

### 3. **Component Communication**
- Event dispatching between components
- Automatic component refresh
- Flash message system

### 4. **Database Integration**
- Eloquent relationships (hasMany, belongsTo)
- Eager loading with `with()`
- Proper foreign key constraints

## 🎨 UI/UX Features

- **Responsive Design** with Tailwind CSS
- **Real-time Feedback** for all user interactions
- **Clean Interface** with intuitive controls
- **Success Messages** for completed actions
- **Error Handling** with clear validation messages

## 🚀 Advanced Features

### Real-time Updates
- Polls list updates automatically when new polls are created
- No page refresh required
- Seamless user experience

### Validation System
- Client-side validation with server-side verification
- Custom error messages
- Real-time validation feedback

### Component Architecture
- Modular Livewire components
- Separation of concerns
- Reusable component patterns

## 📚 Learning Outcomes

This project demonstrates:

- **Livewire 3 Best Practices**
- **Real-time Validation Patterns**
- **Component Communication**
- **Dynamic Form Handling**
- **Database Relationships**
- **Event-driven Architecture**

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Ahmed Aladdin Khidr**
- GitHub: [@Ahmed-Aladdin-Khidr](https://github.com/Ahmed-Aladdin-Khidr)

## 🙏 Acknowledgments

- Laravel team for the amazing framework
- Livewire team for the reactive components
- Tailwind CSS for the utility-first styling
- The Laravel community for continuous inspiration

---

**Built with ❤️ using Laravel Livewire 3**