<x-app>
    <h2>Edit {{ $employee->name }}</h2>
    <form
        class="form-employee"
        id="form-employee-edit">
        <x-input
            :name="'name'"
            :placeholder="'Name'"
            :value="$employee->name"/>

        <x-input
            :name="'surname'"
            :placeholder="'Surname'"
            :value="$employee->surname"/>

        <x-input
            :type="'date'"
            :name="'date_of_birth'"
            :value="$employee->date_of_birth"/>

        <x-input
            :name="'email'"
            :placeholder="'Email'"
            :value="$employee->email"/>

        <x-select
            :name="'employee_role_id'">
            <option disabled>Role</option>
            @foreach($employeeRoles as $employeeRole)
                <option value="{{ $employeeRole->id }}" {{ $employeeRole->id === $employee->employee_role_id ? 'selected' : ''}}>{{ $employeeRole->name }}</option>
            @endforeach
        </x-select>

        @csrf
        <x-button>
            Edit employee
        </x-button>
    </form>

    <x-slot name="scripts">
        <script>
            let formEmployeeEdit = $('#form-employee-edit');
            formEmployeeEdit.validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100
                    },
                    date_of_birth: {
                        required: true,
                        dateISO: true,
                        age: [18, 65]
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    employee_role_id: {
                        required: true
                    }
                },

                errorClass: 'form-error',

                submitHandler: function () {
                    $.ajax({
                        url: "{{ url('employee', $employee->id) }}",
                        type: 'PUT',
                        data: formEmployeeEdit.serialize(),
                        success: function (response) {
                            window.location = response.redirect_to;
                        },
                        error: function (error) {
                            console.error(error.responseJSON.message)
                        }
                    });
                }
            });

            $.validator.addMethod('age', function (value, element, range) {
                let dateToday = new Date(value);
                let monthDifference = Date.now() - dateToday.getTime();
                let employeeYearOfBirth = new Date(monthDifference).getUTCFullYear();
                let age = Math.abs(employeeYearOfBirth - 1970);

                return age > range[0] && age < range[1];
            }, 'Age not between 15 and 65 years old.');
        </script>
    </x-slot>
</x-app>
