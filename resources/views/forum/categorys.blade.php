<a class="btn btn-default" href="#" type="button" class="dropdown" data-toggle="modal" data-target="#category">
  Forum Kategori <span class="glyphicon glyphicon-chevron-right"></span>
</a>

<!-- Modal -->
<div class="modal left fade" id="category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header category-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&#60; close</span></button>
        <h4 class="modal-title" id="myModalLabel">Kategori</h4>
      </div>

      <div class="modal-body">
        <table class="table" id="modal-table">
          @foreach($categorys->where('parent_forum',null) as $category)
            <tr>
              <td <?php
                if($category->parentForum()->count()){
                  echo 'style="background-color: grey; color: white;"';
                }
                if($category->parentForum()->count() < 1){
                  echo 'style="background-color: unset; color: unset;"'; 
                }
              ?> >
                @if($category->parentForum()->count())
                  {{$category->menu}}
                @endif
                @if($category->parentForum()->count() < 1)
                  <a href="/category/{{$category->url}}" style="display: block; color: unset;">{{$category->menu}}</a>
                @endif
              </td>
              @foreach($categorys->where('parent_forum',$category->id) as $child)
                <tr><td style="padding-left: 20px;"><a href="/category/{{$child->url}}" style="display: block; color: unset;">{{$child->menu}}</a></td></tr>
              @endforeach
            </tr>
          @endforeach
        </table>
      </div>

    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->
