<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- قسم الإحصائيات (3 كارتات في البيسي، 1 في الموبايل) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                <div class="bg-blue-600 p-6 rounded-2xl shadow-lg text-white">
                    <p class="text-blue-100 text-sm font-medium">مجموع المصاريف</p>
                    <h3 class="text-3xl font-bold mt-1">{{ number_format($totalAmount, 2) }} <span class="text-lg">DH</span></h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-gray-500 text-sm font-medium">نصيب كل واحد</p>
                    <h3 class="text-3xl font-bold mt-1 text-gray-800">{{ number_format($averageShare, 2) }} <span class="text-lg text-gray-400">DH</span></h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sm:col-span-2 lg:col-span-1">
                    <p class="text-gray-500 text-sm font-medium">عدد الدراري</p>
                    <h3 class="text-3xl font-bold mt-1 text-gray-800">{{ $users->count() }} <span class="text-lg text-gray-400">أشخاص</span></h3>
                </div>
            </div>

            <!-- قسم الاقتراحات (شكون يخلص شكون) -->
            @if(count($suggestions) > 0)
            <div class="mb-8 bg-orange-50 border-r-4 border-orange-500 p-6 rounded-xl shadow-sm">
                <h4 class="text-orange-800 font-bold mb-3 flex items-center">
                    <span class="mr-2 text-xl">💡</span> تصفية الحسابات المقترحة:
                </h4>
                <div class="space-y-3">
                    @foreach($suggestions as $sugg)
                    <div class="flex flex-wrap items-center justify-between bg-white/50 p-3 rounded-lg border border-orange-100">
                        <span class="text-gray-700 font-medium">
                            <b class="text-red-500">{{ $sugg['from'] }}</b> ⮕ <b class="text-green-600">{{ $sugg['to'] }}</b>
                        </span>
                        <span class="font-bold text-gray-900">{{ number_format($sugg['amount'], 2) }} DH</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- فورم الإضافة (يسار في البيسي) -->
                <div class="lg:col-span-4 order-2 lg:order-1">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-6">➕ زيد مصروف جديد</h3>
                        <form action="{{ route('expenses.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">شنو شريتي؟</label>
                                <input type="text" name="title" placeholder="مثلاً: بوطة، خضرة..." class="w-full border-gray-200 rounded-xl focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">الثمن (DH)</label>
                                <input type="number" step="0.01" name="amount" placeholder="0.00" class="w-full border-gray-200 rounded-xl focus:ring-blue-500" required>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-md">
                                حفظ المصروف
                            </button>
                        </form>

                        <hr class="my-6">
                        
                        <form action="{{ route('expenses.settle') }}" method="POST" onsubmit="return confirm('واش بصح تخلصتو كاملين؟ هادشي غيصفر الحساب!')">
                            @csrf
                            {{-- <button type="submit" class="w-full bg-gray-100 hover:bg-red-50 text-gray-600 hover:text-red-600 font-medium py-3 rounded-xl transition border border-dashed border-gray-300">
                                🧼 تصفية الحساب (Settle)
                            </button> --}}
                        </form>
                    </div>
                </div>

                <!-- جدول الوضعية (يمين في البيسي) -->
                <div class="lg:col-span-8 order-1 lg:order-2 space-y-6">
                    <!-- كرتات المستخدمين -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                            <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">وضعية الدراري</h3>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach($users as $user)
                            <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between hover:bg-gray-50 transition">
                                <div class="flex items-center space-x-4 space-x-reverse">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $user->name }}</h4>
                                        <p class="text-xs text-gray-400">خلص فالمجموع: {{ number_format($user->expenses_sum_amount ?? 0, 2) }} DH</p>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 text-right">
                                    @php $bal = ($user->expenses_sum_amount ?? 0) - $averageShare; @endphp
                                    @if($bal >= 0)
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold bg-green-100 text-green-700">
                                            كيسال: +{{ number_format($bal, 2) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold bg-red-100 text-red-700">
                                            عليه: {{ number_format($bal, 2) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- سجل المصاريف الأخيرة -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50">
                            <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">آخر العمليات</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-right">
                                <thead class="bg-gray-50 text-gray-500 text-xs">
                                    <tr>
                                        <th class="px-6 py-3">المستفيد</th>
                                        <th class="px-6 py-3">السبب</th>
                                        <th class="px-6 py-3">الثمن</th>
                                        <th class="px-6 py-3">الوقت</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse($expenses as $expense)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-bold text-gray-700 text-sm">{{ $expense->user->name }}</td>
                                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $expense->title }}</td>
                                        <td class="px-6 py-4 font-mono font-bold text-blue-600">{{ number_format($expense->amount, 2) }}</td>
                                        <td class="px-6 py-4 text-gray-400 text-xs">{{ $expense->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-gray-400">باقي ماكاين تا مصروف فهاد الدورة</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>