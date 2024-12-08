
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>No rekening</th>
            <th>Nama Pegawai</th>
            <th>Pos Anggaran</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0" id="tbody">
          @foreach ($penugasan as $k => $v)      
          <tr>
              {{-- <td>{{ $index + $surat->firstItem() }}</td> --}}
              <td>{{ $k+1 }}</td>
              <td>
                 @foreach ($v->surat as $item)
                     {{ $item->pegawai->rekening }}
                  @endforeach
              </td>
              <td>
                 @foreach ($v->surat as $item)
                     {{ $item->pegawai->nama_karyawan }}
                  @endforeach
              </td>
              <td>{{ $v->anggaran->kegiatan }}</td>
             
          </tr>
          @endforeach
        </tbody>
      </table>