@extends('layouts.admin')

@section('title', 'Backup & Maintenance Documentation')
@section('subtitle', 'Policies, Procedures & Disaster Recovery')

@section('content')
<div class="p-8" x-data="{ openSection: null }">

    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.backup-maintenance.index') }}" class="text-sm text-sea-green hover:text-deep-forest font-semibold transition mb-2 inline-block">
            &larr; Back to Dashboard
        </a>
        <h1 class="text-3xl font-bold text-deep-forest flex items-center gap-3">
            <svg class="w-8 h-8 text-sea-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
            </svg>
            Backup & Maintenance Documentation
        </h1>
        <p class="text-gray-600 mt-2">Standard operating procedures for the RESIDENTE platform</p>
    </div>

    <div class="space-y-4">

        {{-- Section 1: Database Backup Procedures --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <button @click="openSection = openSection === 1 ? null : 1"
                    class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-sea-green/10 text-sea-green flex items-center justify-center text-sm font-black">1</span>
                    Database Backup Procedures
                </h2>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openSection === 1 && 'rotate-180'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </button>
            <div x-show="openSection === 1" x-collapse class="px-6 pb-6 border-t border-gray-100">
                <div class="prose prose-sm max-w-none mt-4 text-gray-700 space-y-4">
                    <h3 class="text-base font-bold text-gray-800">Backup Schedule</h3>
                    <ul class="list-disc pl-5 space-y-1">
                        <li><strong>Automated:</strong> Daily at 02:00 AM (via <code>backup:database</code> artisan command)</li>
                        <li><strong>Manual:</strong> On-demand via Admin Panel &gt; Backup & Maintenance &gt; "Create Backup Now"</li>
                        <li><strong>CLI:</strong> <code>php artisan backup:database</code></li>
                    </ul>

                    <h3 class="text-base font-bold text-gray-800">Backup Location</h3>
                    <p><code>storage/app/private/backups/</code> — this directory is not publicly accessible.</p>

                    <h3 class="text-base font-bold text-gray-800">Retention Policy</h3>
                    <p>Backups older than <strong>30 days</strong> are automatically pruned during the daily scheduled backup run.</p>

                    <h3 class="text-base font-bold text-gray-800">Backup Method</h3>
                    <p>The MySQL database is exported using <code>mysqldump</code> with <code>--single-transaction --routines --triggers</code> flags and compressed using gzip. Resulting file format: <code>backup_2026-04-06_020000.sql.gz</code></p>
                    <ul class="list-disc pl-5 space-y-1 mt-2">
                        <li>Database credentials are passed via <code>MYSQL_PWD</code> environment variable (never exposed in process arguments)</li>
                        <li>Backups include stored procedures, triggers, and all table data within a consistent transaction snapshot</li>
                    </ul>

                    <h3 class="text-base font-bold text-gray-800">Integrity Verification</h3>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>A <strong>SHA-256 hash</strong> is computed and stored for each backup at creation time</li>
                        <li>Before any download, the stored hash is compared against the file on disk — mismatches are flagged and logged as suspicious</li>
                        <li>Check the Backup History page for <span class="text-red-600 font-semibold">Failed</span> or <span class="text-tiger-orange font-semibold">Tampered</span> entries</li>
                        <li>Periodically download a backup and test restoration on a staging environment to verify data integrity</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Section 2: Backup Restoration --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <button @click="openSection = openSection === 2 ? null : 2"
                    class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-sea-green/10 text-sea-green flex items-center justify-center text-sm font-black">2</span>
                    Backup Restoration Procedure
                </h2>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openSection === 2 && 'rotate-180'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </button>
            <div x-show="openSection === 2" x-collapse class="px-6 pb-6 border-t border-gray-100">
                <div class="prose prose-sm max-w-none mt-4 text-gray-700 space-y-3">
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-4">
                        <p class="text-sm text-amber-800 font-semibold flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                            </svg>
                            Always enable maintenance mode before restoring a database backup.
                        </p>
                    </div>
                    <ol class="list-decimal pl-5 space-y-3">
                        <li><strong>Enable Maintenance Mode</strong> — Use the admin panel toggle or run <code>php artisan down --secret=YOUR_SECRET</code></li>
                        <li><strong>Locate the Backup</strong> — Go to <code>storage/app/private/backups/</code> and identify the <code>.sql.gz</code> file to restore (or download it from the Backup History page)</li>
                        <li><strong>Verify Backup Integrity</strong> — Check that the file's SHA-256 hash matches the hash stored in the backup_logs table (the History page shows integrity status)</li>
                        <li><strong>Decompress the Backup</strong> — Run: <code>gunzip backup_YYYY-MM-DD_HHMMSS.sql.gz</code> to produce the <code>.sql</code> file</li>
                        <li><strong>Export Current Database (safety)</strong> — Create a fresh backup of the current state before overwriting: <code>php artisan backup:database --type=manual</code></li>
                        <li><strong>Import the Backup</strong> — Execute:
                            <div class="bg-gray-100 rounded p-3 mt-1">
                                <code class="text-xs">mysql -u root -p residente_app_db &lt; backup_YYYY-MM-DD_HHMMSS.sql</code>
                            </div>
                        </li>
                        <li><strong>Run Migrations</strong> — Execute <code>php artisan migrate</code> to apply any pending migrations added after the backup was created</li>
                        <li><strong>Bring App Online</strong> — Use the admin panel toggle or run <code>php artisan up</code></li>
                        <li><strong>Verify Data</strong> — Log in to the admin panel and check key data (resident counts, recent records, household data) to confirm integrity</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Section 3: Server Maintenance Schedule --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <button @click="openSection = openSection === 3 ? null : 3"
                    class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-sea-green/10 text-sea-green flex items-center justify-center text-sm font-black">3</span>
                    Server Maintenance Schedule
                </h2>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openSection === 3 && 'rotate-180'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </button>
            <div x-show="openSection === 3" x-collapse class="px-6 pb-6 border-t border-gray-100">
                <div class="prose prose-sm max-w-none mt-4 text-gray-700 space-y-4">
                    <h3 class="text-base font-bold text-gray-800">Weekly</h3>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Check disk space usage via Backup & Maintenance dashboard</li>
                        <li>Review Activity Logs for suspicious or critical entries</li>
                        <li>Verify that automated backups are completing successfully</li>
                    </ul>
                    <h3 class="text-base font-bold text-gray-800">Monthly</h3>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Review user accounts and deactivate inactive users</li>
                        <li>Check for Laravel and PHP security updates</li>
                        <li>Clear old log files from <code>storage/logs/</code></li>
                        <li>Test downloading and opening a backup file for integrity</li>
                    </ul>
                    <h3 class="text-base font-bold text-gray-800">Quarterly</h3>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Perform a full test of the disaster recovery procedure</li>
                        <li>Review and update this documentation</li>
                        <li>Audit user permissions and role assignments</li>
                    </ul>
                    <h3 class="text-base font-bold text-gray-800">Annually</h3>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Infrastructure review and capacity planning</li>
                        <li>Review data retention policies</li>
                        <li>Update emergency contact information</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Section 4: Maintenance Mode Protocol --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <button @click="openSection = openSection === 4 ? null : 4"
                    class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-sea-green/10 text-sea-green flex items-center justify-center text-sm font-black">4</span>
                    Maintenance Mode Protocol
                </h2>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openSection === 4 && 'rotate-180'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </button>
            <div x-show="openSection === 4" x-collapse class="px-6 pb-6 border-t border-gray-100">
                <div class="prose prose-sm max-w-none mt-4 text-gray-700 space-y-4">
                    <h3 class="text-base font-bold text-gray-800">When to Use</h3>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Planned database migrations or schema changes</li>
                        <li>Major application updates or deployments</li>
                        <li>Data restoration from backup</li>
                        <li>Emergency security patches</li>
                    </ul>
                    <h3 class="text-base font-bold text-gray-800">How to Activate</h3>
                    <ul class="list-disc pl-5 space-y-1">
                        <li><strong>Admin Panel:</strong> Backup & Maintenance &gt; "Enable Maintenance Mode"</li>
                        <li><strong>CLI:</strong> <code>php artisan down --secret=YOUR_SECRET</code></li>
                    </ul>
                    <h3 class="text-base font-bold text-gray-800">Secret Bypass</h3>
                    <p>When enabling maintenance mode, a random secret URL is generated (e.g., <code>https://yoursite.com/abc123...</code>). Visit this URL to set a bypass cookie that lets you access the full app while others see the 503 page.</p>
                    <h3 class="text-base font-bold text-gray-800">Communication</h3>
                    <p>Before planned downtime, post an announcement via the Announcements module to notify users. Keep maintenance windows under <strong>30 minutes</strong> when possible.</p>
                </div>
            </div>
        </div>

        {{-- Section 5: Disaster Recovery Plan --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <button @click="openSection = openSection === 5 ? null : 5"
                    class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-sea-green/10 text-sea-green flex items-center justify-center text-sm font-black">5</span>
                    Disaster Recovery Plan
                </h2>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openSection === 5 && 'rotate-180'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </button>
            <div x-show="openSection === 5" x-collapse class="px-6 pb-6 border-t border-gray-100">
                <div class="prose prose-sm max-w-none mt-4 text-gray-700 space-y-4">
                    <h3 class="text-base font-bold text-gray-800">Recovery Priorities</h3>
                    <ol class="list-decimal pl-5 space-y-2">
                        <li><strong>Priority 1 — Database:</strong> The MySQL database (<code>residente_app_db</code>) contains all resident records, household data, and system configuration. Backup files (<code>.sql.gz</code>) are the most critical asset.</li>
                        <li><strong>Priority 2 — User Files:</strong> Uploaded documents in <code>storage/app/private/</code> (e.g., PhilSys verification cards, resident photos).</li>
                        <li><strong>Priority 3 — Environment Config:</strong> The <code>.env</code> file contains API keys and database configuration. Back this up separately — never commit it to git.</li>
                        <li><strong>Priority 4 — Application Code:</strong> Maintained in the git repository and can be re-deployed at any time.</li>
                    </ol>
                    <h3 class="text-base font-bold text-gray-800">Recovery Objectives</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase">Recovery Time Objective (RTO)</p>
                                <p class="text-xl font-bold text-deep-forest">1 Hour</p>
                                <p class="text-xs text-gray-500">Maximum tolerable downtime</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase">Recovery Point Objective (RPO)</p>
                                <p class="text-xl font-bold text-deep-forest">24 Hours</p>
                                <p class="text-xs text-gray-500">Maximum tolerable data loss (daily backup cycle)</p>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-base font-bold text-gray-800">Off-Site Backup Recommendation</h3>
                    <p>Periodically copy backup files to an external drive or cloud storage (Google Drive, OneDrive) for protection against hardware failure, theft, or natural disaster. Keep at least <strong>one off-site copy per week</strong>.</p>
                </div>
            </div>
        </div>

        {{-- Section 6: Security Considerations --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <button @click="openSection = openSection === 6 ? null : 6"
                    class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-sea-green/10 text-sea-green flex items-center justify-center text-sm font-black">6</span>
                    Security & Compliance (RA 10173)
                </h2>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openSection === 6 && 'rotate-180'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </button>
            <div x-show="openSection === 6" x-collapse class="px-6 pb-6 border-t border-gray-100">
                <div class="prose prose-sm max-w-none mt-4 text-gray-700 space-y-3">
                    <h3 class="text-base font-bold text-gray-800">Data Privacy Compliance (RA 10173)</h3>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-3">
                        <p class="text-sm text-blue-800">Under the <strong>Data Privacy Act of 2012 (RA 10173)</strong>, the Municipality of Buguey is a Personal Information Controller (PIC) responsible for protecting the personal and sensitive personal information of all residents stored in this system.</p>
                    </div>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>Sensitive Data:</strong> Backup files contain all resident PII (names, addresses, PhilSys numbers, household data). Treat backups with the same security classification as the live database.</li>
                        <li><strong>Access Control:</strong> Only Super Administrators can access the Backup & Maintenance module. All actions are recorded in the Activity Log with full audit trail (operator identity, IP, timestamp).</li>
                        <li><strong>Storage Location:</strong> Backups are stored in <code>storage/app/private/backups/</code>, which is not publicly accessible via the web server.</li>
                        <li><strong>File Integrity:</strong> Every backup is hashed with SHA-256 at creation. Downloads verify the hash before serving, and mismatches are flagged as suspicious in the audit trail.</li>
                        <li><strong>Credential Security:</strong> MySQL passwords are passed via environment variables (never in process arguments or log files). The <code>.env</code> file must never be included in backups or version control.</li>
                        <li><strong>Encryption:</strong> If transferring backups to off-site storage, encrypt the files using GPG or a strong password. Off-site copies must comply with the same access restrictions as on-site data.</li>
                        <li><strong>Data Breach Protocol:</strong> In the event of unauthorized access to backup files, immediately notify the NPC (National Privacy Commission) and affected data subjects as required by RA 10173 Sections 20(f) and 21.</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Section 7: Emergency Contacts --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <button @click="openSection = openSection === 7 ? null : 7"
                    class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg bg-sea-green/10 text-sea-green flex items-center justify-center text-sm font-black">7</span>
                    Emergency Contacts & Escalation
                </h2>
                <svg class="w-5 h-5 text-gray-400 transition-transform" :class="openSection === 7 && 'rotate-180'" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                </svg>
            </button>
            <div x-show="openSection === 7" x-collapse class="px-6 pb-6 border-t border-gray-100">
                <div class="prose prose-sm max-w-none mt-4 text-gray-700">
                    <div class="bg-gray-50 rounded-lg p-5 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="border border-gray-200 rounded-lg p-4 bg-white">
                                <p class="text-xs font-bold text-gray-500 uppercase mb-1">System Administrator</p>
                                <p class="font-semibold text-gray-800">___________________________</p>
                                <p class="text-sm text-gray-500 mt-1">Phone: ___________________</p>
                                <p class="text-sm text-gray-500">Email: ___________________</p>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4 bg-white">
                                <p class="text-xs font-bold text-gray-500 uppercase mb-1">IT Support / Developer</p>
                                <p class="font-semibold text-gray-800">___________________________</p>
                                <p class="text-sm text-gray-500 mt-1">Phone: ___________________</p>
                                <p class="text-sm text-gray-500">Email: ___________________</p>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4 bg-white">
                                <p class="text-xs font-bold text-gray-500 uppercase mb-1">Municipal IT Office</p>
                                <p class="font-semibold text-gray-800">___________________________</p>
                                <p class="text-sm text-gray-500 mt-1">Phone: ___________________</p>
                                <p class="text-sm text-gray-500">Email: ___________________</p>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4 bg-white">
                                <p class="text-xs font-bold text-gray-500 uppercase mb-1">Hosting Provider Support</p>
                                <p class="font-semibold text-gray-800">___________________________</p>
                                <p class="text-sm text-gray-500 mt-1">Phone: ___________________</p>
                                <p class="text-sm text-gray-500">Email: ___________________</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 italic">Fill in the contact details above and keep this page accessible to all authorized system administrators.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
