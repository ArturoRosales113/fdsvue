<div class="col-md-12">
 <div class="card">
  <div class="card-header">
   <h4 class="card-title">Categorias</h4>
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
        Descripción
       </th>
       <th class="text-center" style="max-width: 100px;">
        #Platillos
       </th>

       <th class="text-right">
        Acciones
       </th>
      </tr>
     </thead>
     <tbody>
      @foreach ($categories as $cat)
       <tr>
        <td class="text-center">
         {{ $cat -> id }}
        </td>
        <td>
         {{ $cat -> display_name }}
        </td>
        <td style="max-width: 200px;">
         <span class="d-inline-block" style="max-width: 200px;">
          {{ $cat -> description }}
         </span>
        </td>
        <td class="text-center" style="max-width: 50px;">
         {{ $cat->dishes->count()  }}
        </td>
        <td class="text-right">
          <a href="{{ route('category.show', $cat -> id) }}" rel="tooltip" class="btn btn-success btn-icon btn-sm   btn-neutral  " data-original-title="Ver" title="Ver"><i class="fa fa-search"></i></a>
         <a href="{{ route('category.edit', $cat -> id) }}" rel="tooltip" class="btn btn-info btn-icon btn-sm   btn-neutral  " data-original-title="Editar" title="Editar"><i class="fa fa-edit"></i></a>
            {{ Form::open(['route' => ['category.destroy',$cat->id],'class' => 'pull-right hidden','method', 'DELETE']) }}
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
