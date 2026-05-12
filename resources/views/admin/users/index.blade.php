class="flex items-center gap-3"<x-admin-layout>
    <x-slot name="title">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 4px; height: 28px; background: linear-gradient(to bottom, #d4af37, #aa8c2c); border-radius: 2px;"></div>
            <span>User Management</span>
        </div>
    </x-slot>
    <x-slot name="subtitle">Review verification, update roles, manage account status, and safely control user access.</x-slot>

    <div class="rounded-2xl bg-white overflow-hidden shadow-lg border border-slate-200">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="text-left" style="background: linear-gradient(135deg, #0f1f4a 0%, #1a2f5a 100%); color: #d4af37;">
                        <th class="py-4 px-6 font-bold uppercase text-xs tracking-wider">Full Name</th>
                        <th class="py-4 px-6 font-bold uppercase text-xs tracking-wider">Email</th>
                        <th class="py-4 px-6 font-bold uppercase text-xs tracking-wider">Birthday</th>
                        <th class="py-4 px-6 font-bold uppercase text-xs tracking-wider">Role</th>
                        <th class="py-4 px-6 font-bold uppercase text-xs tracking-wider">Status</th>
                        <th class="py-4 px-6 font-bold uppercase text-xs tracking-wider">Email Verification</th>
                        <th class="py-4 px-6 font-bold uppercase text-xs tracking-wider">Date Registered</th>
                        <th class="py-4 px-6 font-bold uppercase text-xs tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 px-6 font-semibold text-slate-900">{{ $user->name }}</td>
                            <td class="py-4 px-6 text-slate-700">{{ $user->email }}</td>
                            <td class="py-4 px-6 text-slate-700">{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('M d, Y') : 'N/A' }}</td>
                            <td class="py-4 px-6">
                                <span class="inline-block px-3 py-1.5 rounded-xl text-xs font-bold uppercase tracking-wider" style="background: rgba(15, 31, 74, 0.1); color: #0f1f4a;">
                                    {{ $user->is_admin ? 'Admin' : 'User' }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-2">
                                    <span style="width: 8px; height: 8px; background: #22c55e; border-radius: 50%; display: inline-block;"></span>
                                    <span style="color: #22c55e; font-weight: 600; font-size: 0.75rem; text-transform: uppercase;">Active</span>
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-2">
                                    @if($user->email_verified_at)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4" style="color: #22c55e;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span style="color: #22c55e; font-weight: 600; font-size: 0.75rem; text-transform: uppercase;">Verified</span>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4" style="color: #ef4444;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span style="color: #ef4444; font-weight: 600; font-size: 0.75rem; text-transform: uppercase;">Not Verified</span>
                                    @endif
                                </span>
                            </td>
                            <td class="py-4 px-6 text-slate-700">{{ $user->created_at?->format('M d, Y') }}</td>
                            <td class="py-4 px-6">
                                <form method="POST" action="{{ route('admin.users.update', $user) }}" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_admin" value="{{ $user->is_admin ? 0 : 1 }}">
                                    <button type="submit" class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider transition" style="background: {{ $user->is_admin ? 'rgba(34, 197, 94, 0.1)' : 'rgba(212, 175, 55, 0.1)' }}; color: {{ $user->is_admin ? '#22c55e' : '#d4af37' }};">
                                        {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 px-6 pb-6 text-slate-600">{{ $users->links() }}</div>
    </div>
</x-admin-layout>
