<div class="col-md-12">
 <div class="card">
  <div class="card-header">
   <h4 class="card-title">Platillos</h4>
  </div>
  <div class="card-body">
   <div class="table-responsive">
    <table class="table">
     <thead class="text-primary">
      <tr>
       <th class="text-center">
        #
       </th>
       <th>
        Nombre
       </th>
       <th style="max-width: 200px;">
        Email
       </th>
       <th class="text-right">
        Acciones
       </th>
      </tr>
     </thead>
     <tbody>
      @foreach ($users as $user)
       <tr>
        <td class="text-center">
         {{ $user -> id }}
        </td>
        <td>
         {{ $user -> name }}
        </td>
        <td style="max-width: 200px;">
         <span class="d-inline-block" style="max-width: 200px;">
          {{ $user -> email }}
         </span>
        </td>

        <td class="text-right">
          <a href="{{ route('user.show', $user -> id) }}" rel="tooltip" class="btn btn-success btn-icon btn-sm   btn-neutral  " data-original-title="Ver" title="Ver"><i class="fa fa-search"></i></a>
         <a href="{{ route('user.edit', $user -> id) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm   btn-neutral  " data-original-title="Editar" title="Editar"><i class="fa fa-edit"></i></a>
            {{ Form::open(array('route' => ['user.destroy', $user->id], 'class' => 'pull-right hidden')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::button(' <i class="fa fa-times"></i>', array('type' => 'submit','class' => 'btn btn-danger btn-icon btn-sm btn-neutral','rel' => 'tooltip','data-original-title' => 'Eliminar', 'title' => 'Eliminar')) }}
            {{ Form::close() }}
        </td>
       </tr>
      @endforeach
     </tbody>
    </table>
   </div>
  </div>
 </div>
</div>
