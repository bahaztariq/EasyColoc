# 🏠 EasyColoc

**Stress-free expense sharing for minimalist roommates.**

EasyColoc is a modern, premium web application designed to simplify shared living. Track expenses, manage roommates, and settle debts with ease through a beautiful, intuitive interface.

---

## ✨ Key Features

- **🚀 Smart Dashboard**: A comprehensive overview of your colocation's health, including total spent, per-person averages, and quick actions.
- **💸 Expense Management**: Add and categorize expenses with just a few clicks. Track who paid for what and when.
- **🤝 Invitation System**: Secure, time-limited invitation links. New members join automatically upon registration.
- **⚖️ "Who Owes Who"**: Real-time balance calculations that simplify debt settlement. No more spreadsheets or awkward conversations.
- **⭐ Reputation System**: Built-in gamification where users earn reputation points for their activity and timely settlements.
- **📱 Premium UI/UX**: Responsive sidebar layout, sleek glassmorphism modals, and smooth transitions powered by Tailwind CSS and Alpine.js.

---

## 🛠️ Tech Stack

- **Backend**: [Laravel 11](https://laravel.com) (PHP 8.2+)
- **Frontend**: [Tailwind CSS](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev)
- **Database**: [PostgreSQL](https://www.postgresql.org)
- **Authentication**: [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)
- **Icons**: [Heroicons](https://heroicons.com)

---

## ⚙️ Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/bahaztariq/EasyColoc.git
   cd EasyColoc
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Note: Update your `.env` with your PostgreSQL database credentials.*

4. **Run Migrations & Seeders**:
   ```bash
   php artisan migrate --seed
   ```

5. **Start the application**:
   ```bash
   npm run dev
   php artisan serve
   ```

---

## 📸 Screenshots

*(To be added)*

---

## 📄 License

The EasyColoc project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
