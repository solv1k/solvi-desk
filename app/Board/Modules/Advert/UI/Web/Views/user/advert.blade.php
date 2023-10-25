<h1>USER VIEW</h1>
<h3>{{ $advert->title }}</h3>
<p>{{ $advert->description }}</p>
<p>{{ $advert->status->label() }}</p>
<p>{{ $advert->created_at->format('d.m.Y') }}</p>
