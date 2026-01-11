<!-- Password Strength Meter Component -->
<div x-data="passwordStrength()" class="space-y-2">
    <div class="relative">
        <input 
            type="password" 
            x-model="password"
            @input="checkStrength()"
            :class="{'border-red-500': strength.level === 'weak', 'border-yellow-500': strength.level === 'medium', 'border-green-500': strength.level === 'strong'}"
            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="Wprowadź hasło"
        />
    </div>

    <!-- Strength Bar -->
    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
        <div 
            :style="`width: ${strength.strength}%`"
            :class="{
                'bg-red-500': strength.level === 'weak',
                'bg-yellow-500': strength.level === 'medium',
                'bg-green-500': strength.level === 'strong'
            }"
            class="h-full transition-all duration-300"
        ></div>
    </div>

    <!-- Strength Label -->
    <div class="flex items-center justify-between text-sm">
        <span 
            :class="{
                'text-red-600': strength.level === 'weak',
                'text-yellow-600': strength.level === 'medium',
                'text-green-600': strength.level === 'strong'
            }"
            class="font-medium"
        >
            <span x-show="strength.level === 'weak'">Słabe hasło</span>
            <span x-show="strength.level === 'medium'">Średnie hasło</span>
            <span x-show="strength.level === 'strong'">Silne hasło</span>
        </span>
        <span class="text-gray-500" x-text="`${strength.strength}%`"></span>
    </div>

    <!-- Feedback -->
    <div x-show="strength.feedback.length > 0" class="space-y-1">
        <template x-for="(item, index) in strength.feedback" :key="index">
            <div class="flex items-start gap-2 text-sm text-gray-600">
                <svg class="w-4 h-4 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span x-text="item"></span>
            </div>
        </template>
    </div>

    <!-- Requirements Checklist -->
    <div class="space-y-2 text-sm">
        <div class="flex items-center gap-2" :class="password.length >= 8 ? 'text-green-600' : 'text-gray-400'">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>Co najmniej 8 znaków</span>
        </div>
        <div class="flex items-center gap-2" :class="/[A-Z]/.test(password) ? 'text-green-600' : 'text-gray-400'">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>Co najmniej jedna wielka litera</span>
        </div>
        <div class="flex items-center gap-2" :class="/[a-z]/.test(password) ? 'text-green-600' : 'text-gray-400'">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>Co najmniej jedna mała litera</span>
        </div>
        <div class="flex items-center gap-2" :class="/[0-9]/.test(password) ? 'text-green-600' : 'text-gray-400'">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>Co najmniej jedna cyfra</span>
        </div>
        <div class="flex items-center gap-2" :class="/[!@#$%^&*(),.?\":{}|<>]/.test(password) ? 'text-green-600' : 'text-gray-400'">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span>Co najmniej jeden znak specjalny</span>
        </div>
    </div>
</div>

<script>
function passwordStrength() {
    return {
        password: '',
        strength: {
            strength: 0,
            level: 'weak',
            feedback: []
        },
        
        checkStrength() {
            let strength = 0;
            let feedback = [];

            // Długość
            if (this.password.length >= 8) {
                strength += 20;
            } else {
                feedback.push('Hasło powinno mieć co najmniej 8 znaków');
            }

            if (this.password.length >= 12) {
                strength += 10;
            }

            // Wielkie litery
            if (/[A-Z]/.test(this.password)) {
                strength += 20;
            } else {
                feedback.push('Dodaj wielką literę');
            }

            // Małe litery
            if (/[a-z]/.test(this.password)) {
                strength += 20;
            } else {
                feedback.push('Dodaj małą literę');
            }

            // Cyfry
            if (/[0-9]/.test(this.password)) {
                strength += 20;
            } else {
                feedback.push('Dodaj cyfrę');
            }

            // Znaki specjalne
            if (/[!@#$%^&*(),.?":{}|<>]/.test(this.password)) {
                strength += 10;
            } else {
                feedback.push('Dodaj znak specjalny');
            }

            // Określ poziom
            let level = 'weak';
            if (strength >= 80) {
                level = 'strong';
            } else if (strength >= 60) {
                level = 'medium';
            }

            this.strength = {
                strength: strength,
                level: level,
                feedback: feedback
            };
        }
    }
}
</script>
