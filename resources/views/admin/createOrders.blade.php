@extends ('layouts.admin')

@section ('title', 'McCafe - Create Orders')
@section ('page-name') Create Orders @endsection

@section ('contents')
<div x-data="{
    query: '',
    results: [],
    selectedMenu: null,
    quantity: 1,
    items: [],
    paymentMethod: 'cash',
    notes: '',

    async search() {
        if (this.query.length < 1) { this.results = []; return; }
        const res = await fetch('{{ route('admin.menus.search') }}?q=' + this.query);
        this.results = await res.json();
    },

    select(menu) {
        this.query = menu.name;
        this.selectedMenu = menu;
        this.results = [];
    },

    addItem() {
        if (!this.selectedMenu || this.quantity < 1) return;

        const existing = this.items.find(i => i.menu_id === this.selectedMenu.id);
        if (existing) {
            existing.quantity += parseInt(this.quantity);
            existing.subtotal = existing.quantity * existing.unit_price;
        } else {
            this.items.push({
                menu_id: this.selectedMenu.id,
                name: this.selectedMenu.name,
                unit_price: this.selectedMenu.price,
                quantity: parseInt(this.quantity),
                subtotal: this.selectedMenu.price * parseInt(this.quantity),
            });
        }

        this.query = '';
        this.selectedMenu = null;
        this.quantity = 1;
        this.results = [];
    },

    removeItem(index) {
        this.items.splice(index, 1);
    },

    get totalAmount() {
        return this.items.reduce((sum, i) => sum + i.subtotal, 0);
    },

    formatRupiah(value) {
        return 'Rp ' + value.toLocaleString('id-ID');
    }
}">

    {{-- Header Info --}}
    <div class="flex gap-4 mb-8">
        <div class="w-full bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">No. Order</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $orderNumber }}</p>
                <i class="fa-regular fa-copy text-primary text-2xl"></i>
            </div>
        </div>
        <div class="w-[400px] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Total Amount</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar" x-text="formatRupiah(totalAmount)">Rp 0</p>
                <i class="fa-solid fa-dollar text-primary text-2xl"></i>
            </div>
        </div>
    </div>

    {{-- Nama Pesanan --}}
    <div class="mb-4">
        <label class="font-bold mb-1 block">Nama Pesanan <span class="text-gray-400 font-normal text-sm">(opsional)</span></label>
        <input
            type="text"
            name="order_name"
            form="order-form"
            placeholder="Contoh: Meja 3 - Budi"
            class="border border-primary rounded-xl px-3 py-2 w-full">
    </div>

    {{-- Form Tambah Item --}}
    <div class="flex w-full gap-4 mb-4">

        {{-- Autocomplete --}}
        <div class="relative flex-1">
            <input
                type="text"
                x-model="query"
                @input.debounce.300ms="search"
                @keydown.escape="results = []"
                placeholder="Cari nama menu..."
                class="border border-primary rounded-xl px-2 py-2 w-full">

            <ul x-show="results.length > 0"
                class="absolute z-10 w-full bg-white border border-primary rounded-xl mt-1 shadow-lg overflow-hidden">
                <template x-for="menu in results" :key="menu.id">
                    <li @click="select(menu)"
                        class="px-4 py-2 hover:bg-primary hover:text-white cursor-pointer flex justify-between">
                        <span x-text="menu.name"></span>
                        <span x-text="formatRupiah(menu.price)" class="text-sm opacity-70"></span>
                    </li>
                </template>
            </ul>
        </div>

        <input
            type="number"
            x-model="quantity"
            min="1"
            placeholder="Qty"
            class="border border-primary rounded-xl px-2 py-2 w-24">

        <button
            @click="addItem"
            class="bg-primary text-white rounded-xl px-4 py-2">
            + Add
        </button>
    </div>

    {{-- Tabel Item --}}
    <table class="w-full mt-4 mb-6">
        <thead>
            <tr>
                <th class="border border-primary p-2 rounded-tl-xl">Menu</th>
                <th class="border border-primary p-2">Qty</th>
                <th class="border border-primary p-2">Harga Satuan</th>
                <th class="border border-primary p-2">Subtotal</th>
                <th class="border border-primary p-2 rounded-tr-xl">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="(item, index) in items" :key="index">
                <tr>
                    <td class="border border-primary p-2" x-text="item.name"></td>
                    <td class="border border-primary p-2 text-center" x-text="item.quantity"></td>
                    <td class="border border-primary p-2" x-text="formatRupiah(item.unit_price)"></td>
                    <td class="border border-primary p-2" x-text="formatRupiah(item.subtotal)"></td>
                    <td class="border border-primary p-2 text-center">
                        <button @click="removeItem(index)" class="text-red-500 hover:cursor-pointer">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
            </template>
            <tr x-show="items.length === 0">
                <td colspan="5" class="border border-primary p-2 text-center text-gray-400">
                    Belum ada item ditambahkan
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Detail Pesanan: Pembayaran & Notes --}}
    <div class="grid grid-cols-2 gap-4 mb-6">

        {{-- Metode Pembayaran --}}
        <div class="bg-white border border-primary rounded-2xl px-4 py-3">
            <p class="font-bold mb-3">Metode Pembayaran</p>
            <div class="flex gap-2">
                {{-- Cash --}}
                <button
                    type="button"
                    @click="paymentMethod = 'cash'"
                    :class="paymentMethod === 'cash'
                        ? 'bg-primary text-white border-primary'
                        : 'bg-white text-gray-600 border-gray-300 hover:border-primary hover:text-primary'"
                    class="flex-1 flex items-center justify-center gap-2 border rounded-xl px-3 py-3 transition-all duration-150 font-medium">
                    <i class="fa-solid fa-money-bill-wave text-lg"></i>
                    <span>Cash</span>
                </button>
                {{-- QRIS --}}
                <button
                    type="button"
                    @click="paymentMethod = 'qris'"
                    :class="paymentMethod === 'qris'
                        ? 'bg-primary text-white border-primary'
                        : 'bg-white text-gray-600 border-gray-300 hover:border-primary hover:text-primary'"
                    class="flex-1 flex items-center justify-center gap-2 border rounded-xl px-3 py-3 transition-all duration-150 font-medium">
                    <i class="fa-solid fa-qrcode text-lg"></i>
                    <span>QRIS</span>
                </button>
            </div>
            <p class="text-sm text-gray-400 mt-2">
                Dipilih:
                <span class="text-primary font-semibold" x-text="paymentMethod.toUpperCase()"></span>
            </p>
        </div>

        {{-- Catatan Pesanan --}}
        <div class="bg-white border border-primary rounded-2xl px-4 py-3">
            <p class="font-bold mb-3">Catatan Pesanan</p>
            <textarea
                x-model="notes"
                placeholder="Contoh: es kopinya jangan terlalu manis, tambah es batu..."
                rows="4"
                class="w-full border border-gray-300 rounded-xl px-3 py-2 text-sm resize-none focus:outline-none focus:border-primary transition-colors"
            ></textarea>
            <p class="text-xs text-gray-400 mt-1" x-text="notes.length + ' karakter'"></p>
        </div>

    </div>

    {{-- Submit Form --}}
    <form id="order-form" action="{{ route('admin.orders.store') }}" method="POST" class="mt-2">
        @csrf
        <input type="hidden" name="total_amount" :value="totalAmount">
        <input type="hidden" name="items" :value="JSON.stringify(items)">
        <input type="hidden" name="payment_method" :value="paymentMethod">
        <input type="hidden" name="notes" :value="notes">

        <button
            type="submit"
            :disabled="items.length === 0"
            class="bg-primary text-white rounded-xl px-6 py-2 disabled:opacity-50 disabled:cursor-not-allowed">
            Confirm Order
        </button>
    </form>

</div>
@endsection