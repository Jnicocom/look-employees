<x-app>
    <x-link :href="route('employee.create')">Nuevo usuario</x-link>

    <form class="form-employees" id="form-employees">
        @foreach($employees as $employee)
            <x-grid-item>
                <label class="form-employees__label">
                    <input
                        type="checkbox"
                        name="employees[]"
                        value="{{ $employee->id }}">
                    {{ $employee->name }}
                </label>

                <div class="grid-item__buttons">
                    <x-link :href="route('employee.edit', $employee)">
                        Edit
                    </x-link>

                    <x-button onclick="destroyEmployee(event, {{ $employee->id }})">
                        Delete
                    </x-button>
                </div>
            </x-grid-item>
        @endforeach

        @csrf
        <x-button id="form-employees__destroy-selected-button">Delete selected employees</x-button>
    </form>

    <x-slot name="scripts">
        <script>
            $('#form-employees__destroy-selected-button').on('click', function (event) {
                event.preventDefault();

                $.ajax({
                    url: "/employee/destroy-multiple",
                    type: 'DELETE',
                    data: $('#form-employees').serialize(),
                    success: function (response) {
                        window.location = response.redirect_to;
                    },
                    error: function (error) {
                        console.error(error.responseJSON.message)
                    }
                });
            });

            function destroyEmployee(event, employeeId) {
                event.preventDefault();

                $.ajax({
                    url: 'employee/' + employeeId,
                    type: 'DELETE',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        window.location = response.redirect_to;
                    },
                    error: function (error) {
                        console.error(error.responseJSON.message)
                    }
                });
            }

            $.validator.addMethod('age', function (value, element, range) {
                let dateToday = new Date(value);
                let monthDifference = Date.now() - dateToday.getTime();
                let employeeYearOfBirth = new Date(monthDifference).getUTCFullYear();
                let age = Math.abs(employeeYearOfBirth - 1970);

                return age > range[0] && age < range[1];
            }, 'No cuentas con la edad requerida.');
        </script>
    </x-slot>
</x-app>








