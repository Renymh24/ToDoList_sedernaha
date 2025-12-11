# 📅 DateHelper Documentation

Dokumentasi lengkap untuk **DateHelper** - Helper class untuk formatting tanggal di aplikasi Todo List.

---

## 📋 Daftar Isi

1. [Pendahuluan](#pendahuluan)
2. [Struktur File](#struktur-file)
3. [Alur Kerja](#alur-kerja)
4. [Perbedaan DateHelper dan helpers.php](#perbedaan-datehelper-dan-helpersphp)
5. [Referensi Methods](#referensi-methods)
6. [Penggunaan di Controller](#penggunaan-di-controller)
7. [Penggunaan di View](#penggunaan-di-view)
8. [Registrasi Autoload](#registrasi-autoload)
9. [Keuntungan Arsitektur](#keuntungan-arsitektur)

---

## Pendahuluan

**DateHelper** adalah helper class yang dibuat untuk menstandarkan format tanggal di seluruh aplikasi. Dengan menggunakan DateHelper, kita tidak perlu menformat tanggal berulang kali di setiap controller atau view.

### Masalah yang Diselesaikan

❌ **Sebelum menggunakan DateHelper:**
```php
// Di Controller
$todo->deadline->format('d F Y');

// Di View
{{ \Carbon\Carbon::parse($todo->deadline)->format('M d, Y') }}
{{ \Carbon\Carbon::parse($todo->deadline)->diffForHumans() }}

// Format tidak konsisten, logic di banyak tempat
```

✅ **Setelah menggunakan DateHelper:**
```php
// Di Controller - format sekali
$todo->deadline_formatted = DateHelper::formatIndonesian($todo->deadline);

// Di View - langsung pakai
{{ $todo->deadline_formatted }}

// Konsisten, maintainable, clean
```

---

## Struktur File

```
app/
└── Helpers/
    ├── DateHelper.php      # Class utama dengan static methods
    └── helpers.php         # Global helper functions (opsional)
```

### Lokasi File

| File | Path | Fungsi |
|------|------|--------|
| `DateHelper.php` | `app/Helpers/DateHelper.php` | Class utama dengan semua method formatting |
| `helpers.php` | `app/Helpers/helpers.php` | Wrapper functions untuk kemudahan akses global |

---

## Alur Kerja

```
┌─────────────────────────────────────────────────────────────────┐
│                         DATABASE                                 │
│                    (Raw Date Format)                             │
│                   2025-12-15 00:00:00                            │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│                    CONTROLLER                                    │
│              (TodoController.php)                                │
│                                                                  │
│   $formattedTodo = $this->formatTodoData($todo);                │
│                                                                  │
│   Menggunakan DateHelper untuk format semua tanggal:            │
│   - deadline_formatted     → "15 Desember 2025"                 │
│   - deadline_badge_text    → "4 hari lagi"                      │
│   - deadline_badge_color   → "yellow"                           │
│   - deadline_for_input     → "2025-12-15"                       │
│   - dll...                                                       │
└─────────────────────┬───────────────────────────────────────────┘
                      │
                      ▼
┌─────────────────────────────────────────────────────────────────┐
│                       VIEW                                       │
│              (index.blade.php)                                   │
│                                                                  │
│   Langsung menggunakan data yang sudah diformat:                │
│   {{ $todo->deadline_formatted }}                               │
│   {{ $todo->deadline_badge_text }}                              │
│                                                                  │
│   TIDAK perlu memanggil helper function lagi!                   │
└─────────────────────────────────────────────────────────────────┘
```

### Alur Data Lengkap

```
Database (2025-12-15 00:00:00)
    ↓
Model ToDo ($todo->deadline)
    ↓
Controller: formatTodoData()
    ↓
DateHelper::formatDeadlineWithColor()
DateHelper::formatIndonesian()
DateHelper::daysUntil()
    ↓
Formatted Object:
{
    deadline: "2025-12-15",
    deadline_formatted: "15 Desember 2025",
    deadline_badge_text: "4 hari lagi",
    deadline_badge_color: "yellow",
    deadline_days_until: 4,
    ...
}
    ↓
View: {{ $todo->deadline_badge_text }}
    ↓
Output HTML: "4 hari lagi"
```

---

## Perbedaan DateHelper dan helpers.php

### DateHelper.php

**Tujuan:** Class utama yang berisi semua logic formatting tanggal.

**Karakteristik:**
- Menggunakan namespace `App\Helpers`
- Semua methods bersifat `static`
- Berisi logic lengkap untuk setiap formatting
- Digunakan terutama di **Controller**

**Cara Penggunaan:**
```php
use App\Helpers\DateHelper;

$formatted = DateHelper::formatIndonesian($date);
$badge = DateHelper::formatDeadlineWithColor($date);
```

### helpers.php

**Tujuan:** Wrapper functions global untuk kemudahan akses, terutama di View (jika diperlukan).

**Karakteristik:**
- Tidak menggunakan namespace (global functions)
- Memanggil methods dari DateHelper
- Lebih singkat untuk digunakan
- Opsional - bisa digunakan di **View** jika perlu

**Cara Penggunaan:**
```php
// Tanpa import, langsung panggil
$formatted = formatDate($date);
$badge = formatDeadline($date);
```

### Kapan Menggunakan Masing-masing?

| Situasi | Gunakan |
|---------|---------|
| Di Controller | `DateHelper::method()` |
| Di View (jika tidak diformat di controller) | `formatDate()` dari helpers.php |
| Di Service/Repository | `DateHelper::method()` |
| Di API Response | `DateHelper::method()` |

### Rekomendasi Arsitektur

**Best Practice:** Format semua data di Controller menggunakan `DateHelper`, sehingga View hanya perlu menampilkan data yang sudah diformat. Dengan cara ini, `helpers.php` menjadi opsional.

---

## Referensi Methods

### 1. formatIndonesian($date)

Format tanggal ke bahasa Indonesia lengkap.

```php
DateHelper::formatIndonesian('2025-12-15');
// Output: "15 Desember 2025"

DateHelper::formatIndonesian(null);
// Output: "-"
```

**Parameter:**
- `$date` (string|null) - Tanggal yang akan diformat

**Return:** string

---

### 2. formatWithTime($date)

Format tanggal dengan waktu.

```php
DateHelper::formatWithTime('2025-12-15 14:30:00');
// Output: "15 Desember 2025, 14:30"
```

**Parameter:**
- `$date` (string|null) - Tanggal dengan waktu

**Return:** string

---

### 3. formatShort($date)

Format tanggal pendek (bulan disingkat).

```php
DateHelper::formatShort('2025-12-15');
// Output: "15 Des 2025"
```

**Parameter:**
- `$date` (string|null) - Tanggal yang akan diformat

**Return:** string

---

### 4. formatRelative($date)

Format tanggal relatif menggunakan Carbon diffForHumans.

```php
DateHelper::formatRelative('2025-12-15');
// Output: "4 hari dari sekarang"

DateHelper::formatRelative('2025-12-01');
// Output: "10 hari yang lalu"
```

**Parameter:**
- `$date` (string|null) - Tanggal yang akan diformat

**Return:** string

---

### 5. formatForInput($date)

Format untuk HTML5 date input (Y-m-d).

```php
DateHelper::formatForInput('2025-12-15 14:30:00');
// Output: "2025-12-15"

DateHelper::formatForInput(null);
// Output: ""
```

**Parameter:**
- `$date` (string|null) - Tanggal yang akan diformat

**Return:** string

---

### 6. daysUntil($date)

Menghitung sisa hari dari sekarang. Mengembalikan integer (bukan float).

```php
DateHelper::daysUntil('2025-12-15');
// Output: 4 (4 hari lagi)

DateHelper::daysUntil('2025-12-10');
// Output: -1 (sudah lewat 1 hari)

DateHelper::daysUntil('2025-12-11');
// Output: 0 (hari ini)
```

**Parameter:**
- `$date` (string|null) - Tanggal target

**Return:** int

**Catatan:** Method ini menggunakan `startOfDay()` untuk memastikan perhitungan berdasarkan hari, bukan jam/menit/detik.

---

### 7. formatDeadlineWithColor($date)

Format deadline dengan text dan warna untuk badge UI.

```php
DateHelper::formatDeadlineWithColor('2025-12-11');
// Output: ['text' => 'Hari ini', 'color' => 'red']

DateHelper::formatDeadlineWithColor('2025-12-12');
// Output: ['text' => 'Besok', 'color' => 'orange']

DateHelper::formatDeadlineWithColor('2025-12-14');
// Output: ['text' => '3 hari lagi', 'color' => 'yellow']

DateHelper::formatDeadlineWithColor('2025-12-18');
// Output: ['text' => '7 hari lagi', 'color' => 'blue']

DateHelper::formatDeadlineWithColor('2025-12-25');
// Output: ['text' => '25 Desember 2025', 'color' => 'green']

DateHelper::formatDeadlineWithColor('2025-12-09');
// Output: ['text' => '2 hari terlambat', 'color' => 'red']

DateHelper::formatDeadlineWithColor(null);
// Output: ['text' => 'Tidak ada deadline', 'color' => 'gray']
```

**Parameter:**
- `$date` (string|null) - Tanggal deadline

**Return:** array dengan keys `text` dan `color`

**Logika Warna:**

| Kondisi | Text | Color | Tailwind Classes |
|---------|------|-------|------------------|
| Terlambat (< 0 hari) | `X hari terlambat` | `red` | `bg-red-100 text-red-700` |
| Hari ini (0 hari) | `Hari ini` | `red` | `bg-red-100 text-red-700` |
| Besok (1 hari) | `Besok` | `orange` | `bg-orange-100 text-orange-700` |
| 2-3 hari | `X hari lagi` | `yellow` | `bg-yellow-100 text-yellow-700` |
| 4-7 hari | `X hari lagi` | `blue` | `bg-blue-100 text-blue-700` |
| > 7 hari | Tanggal lengkap | `green` | `bg-green-100 text-green-700` |
| Tidak ada deadline | `Tidak ada deadline` | `gray` | `bg-gray-50 text-gray-500` |

---

### 8. isPast($date)

Cek apakah tanggal sudah lewat.

```php
DateHelper::isPast('2025-12-01');
// Output: true

DateHelper::isPast('2025-12-20');
// Output: false

DateHelper::isPast(null);
// Output: false
```

**Parameter:**
- `$date` (string|null) - Tanggal yang akan dicek

**Return:** bool

---

### 9. isToday($date)

Cek apakah tanggal adalah hari ini.

```php
DateHelper::isToday('2025-12-11');
// Output: true (jika hari ini 11 Des 2025)

DateHelper::isToday('2025-12-12');
// Output: false
```

**Parameter:**
- `$date` (string|null) - Tanggal yang akan dicek

**Return:** bool

---

### 10. isTomorrow($date)

Cek apakah tanggal adalah besok.

```php
DateHelper::isTomorrow('2025-12-12');
// Output: true (jika hari ini 11 Des 2025)

DateHelper::isTomorrow('2025-12-13');
// Output: false
```

**Parameter:**
- `$date` (string|null) - Tanggal yang akan dicek

**Return:** bool

---

## Penggunaan di Controller

### TodoController.php

```php
<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Support\Facades\Auth;
use App\Helpers\DateHelper;

class TodoController extends Controller
{
    public function index()
    {
        $todos = ToDo::where('user_id', Auth::id())
                    ->orderBy('deadline', 'asc')
                    ->get();

        // Update status jika terlambat
        foreach($todos as $todo) {
            if($todo->deadline && DateHelper::isPast($todo->deadline) && $todo->status === 'pending') {
                $todo->update(['status' => 'late']);
            }
        }

        // Format semua todos untuk view
        $formattedTodos = $todos->map(function($todo) {
            return $this->formatTodoData($todo);
        });

        $stats = [
            'total' => $todos->count(),
            'completed' => $todos->where('status', 'completed')->count(),
            'pending' => $todos->where('status', 'pending')->count(),
            'late' => $todos->where('status', 'late')->count(),
        ];

        return view('index', ['todos' => $formattedTodos, 'stats' => $stats]);
    }

    public function edit(ToDo $todo)
    {
        if($todo->user_id !== Auth::id()) {
            abort(403);
        }

        // Format data untuk view
        $formattedTodo = $this->formatTodoData($todo);

        return view('todos.edit', ['todo' => $formattedTodo]);
    }

    /**
     * Format todo data dengan DateHelper
     * 
     * @param ToDo $todo
     * @return object
     */
    private function formatTodoData($todo)
    {
        $deadlineBadge = DateHelper::formatDeadlineWithColor($todo->deadline);
        
        return (object) [
            // Data asli (untuk form, database operations, dll)
            'id' => $todo->id,
            'user_id' => $todo->user_id,
            'title' => $todo->title,
            'description' => $todo->description,
            'status' => $todo->status,
            'deadline' => $todo->deadline,
            'completed_at' => $todo->completed_at,
            'created_at' => $todo->created_at,
            'updated_at' => $todo->updated_at,
            
            // Deadline - Formatted fields
            'deadline_formatted' => DateHelper::formatIndonesian($todo->deadline),
            'deadline_short' => DateHelper::formatShort($todo->deadline),
            'deadline_relative' => DateHelper::formatRelative($todo->deadline),
            'deadline_badge_text' => $deadlineBadge['text'],
            'deadline_badge_color' => $deadlineBadge['color'],
            'deadline_for_input' => DateHelper::formatForInput($todo->deadline),
            'deadline_days_until' => DateHelper::daysUntil($todo->deadline),
            'deadline_is_past' => DateHelper::isPast($todo->deadline),
            'deadline_is_today' => DateHelper::isToday($todo->deadline),
            'deadline_is_tomorrow' => DateHelper::isTomorrow($todo->deadline),
            
            // Completed at - Formatted fields
            'completed_at_formatted' => DateHelper::formatIndonesian($todo->completed_at),
            'completed_at_with_time' => DateHelper::formatWithTime($todo->completed_at),
            
            // Timestamps - Formatted fields
            'created_at_formatted' => DateHelper::formatIndonesian($todo->created_at),
            'updated_at_formatted' => DateHelper::formatIndonesian($todo->updated_at),
        ];
    }
}
```

---

## Penggunaan di View

### index.blade.php

```blade
{{-- Menampilkan tanggal yang sudah diformat --}}
<p>Deadline: {{ $todo->deadline_formatted }}</p>
{{-- Output: Deadline: 15 Desember 2025 --}}


{{-- Badge deadline dengan warna dinamis --}}
@if($todo->deadline)
    <span class="text-sm flex items-center px-3 py-1 rounded-full
        @if($todo->deadline_badge_color === 'red') bg-red-100 text-red-700
        @elseif($todo->deadline_badge_color === 'orange') bg-orange-100 text-orange-700
        @elseif($todo->deadline_badge_color === 'yellow') bg-yellow-100 text-yellow-700
        @elseif($todo->deadline_badge_color === 'blue') bg-blue-100 text-blue-700
        @elseif($todo->deadline_badge_color === 'green') bg-green-100 text-green-700
        @else bg-gray-50 text-gray-500
        @endif">
        <i class="fas fa-calendar-alt mr-2"></i>
        {{ $todo->deadline_badge_text }}
    </span>
@endif
{{-- Output: <span class="... bg-yellow-100 text-yellow-700">3 hari lagi</span> --}}


{{-- Tanggal completion --}}
@if($todo->completed_at)
    <span>Completed: {{ $todo->completed_at_formatted }}</span>
@endif
{{-- Output: Completed: 10 Desember 2025 --}}


{{-- Input date dengan value yang sudah diformat --}}
<input type="date" 
       name="deadline" 
       value="{{ $todo->deadline_for_input }}">
{{-- Output: <input type="date" value="2025-12-15"> --}}


{{-- Conditional berdasarkan status tanggal --}}
@if($todo->deadline_is_past)
    <span class="text-red-500 font-bold">⚠️ Terlambat!</span>
@elseif($todo->deadline_is_today)
    <span class="text-orange-500 font-bold">📌 Hari ini!</span>
@elseif($todo->deadline_is_tomorrow)
    <span class="text-yellow-500 font-bold">⏰ Besok!</span>
@endif


{{-- Menggunakan sisa hari untuk logic --}}
@if($todo->deadline_days_until >= 0 && $todo->deadline_days_until <= 3)
    <div class="bg-yellow-100 p-2 rounded">
        Deadline dalam {{ $todo->deadline_days_until }} hari!
    </div>
@endif
```

### edit.blade.php

```blade
{{-- Menampilkan info deadline saat ini --}}
<div class="mb-4">
    <p class="text-gray-600">
        <i class="fas fa-calendar-alt mr-2"></i>
        Deadline: {{ $todo->deadline_formatted }}
        <span class="ml-3 text-sm px-2 py-1 rounded-full
            @if($todo->deadline_badge_color === 'red') bg-red-200 text-red-800
            @elseif($todo->deadline_badge_color === 'orange') bg-orange-200 text-orange-800
            @elseif($todo->deadline_badge_color === 'yellow') bg-yellow-200 text-yellow-800
            @elseif($todo->deadline_badge_color === 'blue') bg-blue-200 text-blue-800
            @else bg-green-200 text-green-800
            @endif">
            {{ $todo->deadline_badge_text }}
        </span>
    </p>
</div>

{{-- Form input dengan value dari controller --}}
<input type="date" 
       id="deadline" 
       name="deadline" 
       value="{{ old('deadline', $todo->deadline_for_input) }}"
       class="w-full px-4 py-2 border rounded-lg">
```

---

## Registrasi Autoload

### composer.json

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files": [
            "app/Helpers/DateHelper.php",
            "app/Helpers/helpers.php"
        ]
    }
}
```

### Setelah Mengubah composer.json

Jalankan perintah berikut untuk me-refresh autoload:

```bash
composer dump-autoload
```

---

## Keuntungan Arsitektur

| Aspek | Keuntungan |
|-------|------------|
| **Konsistensi** | Format tanggal sama di seluruh aplikasi |
| **Maintainability** | Ubah format di satu tempat (DateHelper), berlaku di semua tempat |
| **Performance** | Format dilakukan sekali di controller, bukan berulang di view |
| **Clean View** | View hanya menampilkan data, tidak ada logic formatting |
| **Testability** | DateHelper mudah di-unit test karena static methods |
| **Reusability** | Bisa digunakan di controller lain, API, service, dll |
| **Separation of Concerns** | Logic ada di Helper, tampilan ada di View |

---

## Contoh Unit Test

```php
<?php

namespace Tests\Unit;

use App\Helpers\DateHelper;
use Tests\TestCase;

class DateHelperTest extends TestCase
{
    public function test_format_indonesian_returns_correct_format()
    {
        $result = DateHelper::formatIndonesian('2025-12-15');
        $this->assertEquals('15 Desember 2025', $result);
    }

    public function test_format_indonesian_returns_dash_for_null()
    {
        $result = DateHelper::formatIndonesian(null);
        $this->assertEquals('-', $result);
    }

    public function test_days_until_returns_integer()
    {
        $result = DateHelper::daysUntil('2025-12-15');
        $this->assertIsInt($result);
    }

    public function test_format_deadline_with_color_returns_correct_structure()
    {
        $result = DateHelper::formatDeadlineWithColor('2025-12-15');
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('text', $result);
        $this->assertArrayHasKey('color', $result);
    }

    public function test_is_past_returns_boolean()
    {
        $this->assertIsBool(DateHelper::isPast('2025-12-01'));
        $this->assertIsBool(DateHelper::isPast(null));
    }
}
```

---

## Changelog

| Versi | Tanggal | Perubahan |
|-------|---------|-----------|
| 1.0.0 | 2025-12-11 | Initial release dengan semua methods |
| 1.0.1 | 2025-12-11 | Fix `daysUntil()` agar return integer, bukan float |

---

## Author

Dibuat untuk proyek **Todo List - Idul Adha Edition**

---

*Dokumentasi ini dibuat pada 11 Desember 2025*
