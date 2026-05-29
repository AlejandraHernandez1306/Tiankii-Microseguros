<div class="bg-white p-6 rounded-xl shadow-md border border-slate-200">
    <h4 class="text-lg font-bold text-slate-700 mb-4">Gestiones Rápidas</h4>
    <div class="grid grid-cols-2 gap-3">
        <button onclick="alert('Conectando con agenda...')" class="flex flex-col items-center justify-center p-4 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition border border-blue-200">
            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span class="text-xs font-bold">Agendar</span>
        </button>
        <button onclick="alert('Stripe Sandbox: Sin deuda.')" class="flex flex-col items-center justify-center p-4 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition border border-indigo-200">
            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            <span class="text-xs font-bold">Pagos</span>
        </button>
    </div>
    <button onclick="alert('SOS ENVIADO')" class="w-full mt-3 bg-red-50 text-red-600 font-bold py-2 rounded-lg border border-red-200 hover:bg-red-100 flex justify-center items-center gap-2 animate-pulse">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        SOS
    </button>
</div>