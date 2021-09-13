<ul>
  @forelse($Smslogsdetails as $pkey => $pvalue)
          @if($chat_user == $pvalue->sender_id )
            <li class="replies">
              <img src="{{ $pvalue->receiver_image }}" alt="" />
              <p>{{ $pvalue->msg_body }}</p>
            </li>
          @else
              <li class="sent">
                <img src="{{ $pvalue->sender_image }}" alt="" />
                <p>{{ $pvalue->msg_body }}</p>
              </li>
          @endif
      @empty

      @endforelse
</ul>